<?php

$unsecuredData = $_GET["data"];

?>


<!DOCTYPE html>
<html lang="tr">

<?php require_once "head.php" ?>

<body>
    <?php require_once "header.php"; ?>

    <div class="container">
        <h1 class="text-center my-3">XSS Güvenlik Açığı</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <?= $unsecuredData ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>