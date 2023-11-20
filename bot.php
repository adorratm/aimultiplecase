<?php



$allCalculations = [];

for ($i = 0; $i < 1000; $i++) {
    // Random numbers
    $number = rand(0, 1000);
    $number2 = rand(0, 1000);
    // Random operator
    $operator = randomOperator();

    // Calculate the result time
    $startTime = microtime(true);

    $result = calculate($number, $number2, $operator);

    $endTime = microtime(true);

    $resultTime = $endTime - $startTime;

    // Add the calculation to the array
    $calculation = [
        'number' => $number,
        'number2' => $number2,
        'operator' => $operator,
        'result' => $result,
        'resultTime' => $resultTime
    ];

    $allCalculations[] = $calculation;
}

$jsonData = json_encode($allCalculations, JSON_PRETTY_PRINT);

if (!file_exists('calculationsResponse.json')) {
    touch('calculationsResponse.json');
}

file_put_contents('calculationsResponse.json', $jsonData);

function randomOperator()
{
    $operatorArr = ['+', '-', '*', '/', '%'];
    return $operatorArr[array_rand($operatorArr)];
}

function calculate($number, $number2, $operator)
{
    switch ($operator) {
        case "+":
            $result = bcadd($number, $number2); // bcadd() is used to prevent integer overflow
            break;
        case "-":
            $result = bcsub($number, $number2); // bcsub() is used to prevent integer overflow
            break;
        case "*":
            $result = bcmul($number, $number2); // bcmul() is used to prevent integer overflow
            break;
        case "/" && $number2 != 0:
            $result = bcdiv($number, $number2); // bcdiv() is used to prevent integer overflow
            break;
        case "%" && $number2 != 0:
            $result = bcmod($number, $number2); // bcmod() is used to prevent integer overflow
            break;
        default:
            $result = "Error";
            break;
    }
    return $result;
}

if (file_exists('calculationsResponse.json')) {
    $readData = file_get_contents('calculationsResponse.json', true);
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Multiple - Case Study </title>
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
</head>

<body>
    <?php require_once "header.php"; ?>

    <div class="container">
        <h1 class="text-center my-3">Hesap Makinesi Botu</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <?php print_r("<pre>"); ?>
                        <?php print_r($readData); ?>
                        <?php print_r("</pre>"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>