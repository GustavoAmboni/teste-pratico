<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title><?= $v_page_title ?></title>
</head>

<body>
    <nav class="mb-3 navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><?= $v_title ?></span>
        </div>
    </nav>
    <div class="container">
        <?php
        if (isset($v_msg)) {
            include_once("Alert.php");
        }
        ?>
        <div class="row justify-content-evenly">
            <div class="col-5">
                <div class="cadastro ">
                    <?php
                    include_once("Cadastro.php");
                    ?>
                </div>
            </div>
            <div class="col-5">
                <div class="dashboard">
                    <?php
                    include_once("Dashboard.php");
                    ?>
                </div>

            </div>
        </div>
    </div>

    </div>
    <script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>