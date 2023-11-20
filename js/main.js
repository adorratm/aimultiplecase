// Calculate From Frontend
const calculate = (n1, operator, n2) => {
    const firstNum = parseFloat(n1)
    const secondNum = parseFloat(n2)
    if (operator === 'add') return firstNum + secondNum
    if (operator === 'subtract') return firstNum - secondNum
    if (operator === 'multiply') return firstNum * secondNum
    if (operator === 'divide') return firstNum / secondNum
    if (operator === 'percentage') return firstNum % secondNum
}

// Get action from data-action attribute
const getKeyType = key => {
    const { action } = key.dataset
    if (!action) return 'number'
    if (
        action === 'add' ||
        action === 'subtract' ||
        action === 'multiply' ||
        action === 'divide' ||
        action === 'percentage'
    ) return 'operator'

    return action
}

// Create result string for display
const createResultString = (key, displayedNum, state) => {
    const keyContent = key.textContent
    const keyType = getKeyType(key)
    const {
        firstValue,
        operator,
        modValue,
        previousKeyType
    } = state

    if (keyType === 'number') {
        return displayedNum === '0' ||
            previousKeyType === 'operator' ||
            previousKeyType === 'calculate'
            ? keyContent
            : displayedNum + keyContent
    }

    if (keyType === 'decimal') {
        if (!displayedNum.includes('.')) return displayedNum + '.'
        if (previousKeyType === 'operator' || previousKeyType === 'calculate') return '0.'
        return displayedNum
    }

    if (keyType === 'operator') {
        return firstValue &&
            operator &&
            previousKeyType !== 'operator' &&
            previousKeyType !== 'calculate'
            ? calculate(firstValue, operator, displayedNum)
            : displayedNum
    }

    if (keyType === 'clear') {
        document.getElementsByClassName("calculatedBackendData")[0].classList.add("d-none");
        document.getElementById("result").innerHTML = "";
        return 0
    } 

    if (keyType === 'backspace') {
        return displayedNum.length === 1 ? 0 : displayedNum.slice(0, -1)
    }

    if (keyType === 'calculate') {
        if(firstValue){
            if (previousKeyType === 'calculate') {
                
                return calculate(displayedNum, operator, modValue)
            }
            calculateBackend(firstValue, operator, displayedNum)
            return calculate(firstValue, operator, displayedNum)
        }
        return displayedNum
    }
}

// Update Calculator State
const updateCalculatorState = (key, calculator, calculatedValue, displayedNum) => {
    const keyType = getKeyType(key)
    const {
        firstValue,
        operator,
        modValue,
        previousKeyType
    } = calculator.dataset

    calculator.dataset.previousKeyType = keyType

    if (keyType === 'operator') {
        calculator.dataset.operator = key.dataset.action
        calculator.dataset.firstValue = firstValue &&
            operator &&
            previousKeyType !== 'operator' &&
            previousKeyType !== 'calculate'
            ? calculatedValue
            : displayedNum
    }

    if (keyType === 'calculate') {
        calculator.dataset.modValue = firstValue && previousKeyType === 'calculate'
            ? modValue
            : displayedNum
    }

    if (keyType === 'clear' && key.textContent === 'AC') {
        calculator.dataset.firstValue = ''
        calculator.dataset.modValue = ''
        calculator.dataset.operator = ''
        calculator.dataset.previousKeyType = ''
    }
}

// Update Visual State
const updateVisualState = (key, calculator) => {
    const keyType = getKeyType(key)
    Array.from(key.parentNode.children).forEach(k => k.classList.remove('is-depressed'))

    if (keyType === 'operator') key.classList.add('is-depressed')
    if (keyType === 'clear' && key.textContent !== 'AC') key.textContent = 'AC'
    if (keyType !== 'clear') {
        const clearButton = calculator.querySelector('[data-action=clear]')
        clearButton.textContent = 'CE'
    }
}

// Define Calculator Variables
const calculator = document.querySelector('.calculator')
const display = calculator.querySelector('.calculator__display')
const keys = calculator.querySelector('.calculator__keys')

// Add Click Event Listener To Keys
keys.addEventListener('click', e => {
    if (!e.target.matches('button')) return
    const key = e.target
    const displayedNum = display.value
    const resultString = createResultString(key, displayedNum, calculator.dataset)

    display.value = resultString
    updateCalculatorState(key, calculator, resultString, displayedNum)
    updateVisualState(key, calculator)
})

// Calculate From Backend
calculateBackend = (n1, operator, n2) => {
    const firstNum = parseFloat(n1)
    const secondNum = parseFloat(n2)

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementsByClassName("calculatedBackendData")[0].classList.remove("d-none");
            document.getElementById("result").innerHTML = "İşlem Sonucu: " + xhr.responseText;
        }
    };

    xhr.open("POST", "calculator.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("number1=" + firstNum + "&number2=" + secondNum + "&operator=" + operator);
}