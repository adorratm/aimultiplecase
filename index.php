<!DOCTYPE html>
<html lang="tr">

<?php require_once "head.php" ?>

<body>
    <?php require_once "header.php"; ?>
    <div class="container">
        <h1 class="text-center my-3">Hesap Makinesi</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="calculatedBackendData d-none">
                            <div class="alert alert-primary">
                                <h3>Sonuç</h3>
                                <div id="result"></div>
                            </div>
                        </div>
                        <form class="calculator" name="calculator" onsubmit="return false" autocomplete="off">
                            <div class="mb-3">
                                <input class="form-control form-control-lg text-end calculator__display" id="calc" type="text" readonly name="answer" autocomplete="off" value="0">
                            </div>
                            <div class="calculator__keys">
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button" data-action="clear">AC</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">7</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">4</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">1</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button" data-action="backspace">B</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">8</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">5</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">2</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="w-100 border mb-2 btn btn-default btn-lg operatorButton" type="button" data-action="percentage">%</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">9</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">6</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">3</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="w-100 border mb-2 btn btn-default btn-lg operatorButton" type="button" data-action="divide">÷</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg operatorButton" type="button" data-action="multiply">x</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg operatorButton" type="button" data-action="subtract">-</button>
                                            <button class="w-100 border mb-2 btn btn-default btn-lg operatorButton" type="button" data-action="add">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="w-100 border mb-2 btn btn-default btn-lg" type="button">0</button>
                                    </div>
                                    <div class="col">
                                        <button class="w-100 border mb-2 btn btn-default btn-lg" type="button" data-action="decimal">.</button>
                                    </div>
                                    <div class="col">
                                        <button class="w-100 border mb-2 btn btn-default btn-lg equalButton" type="button" data-action="calculate">=</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>