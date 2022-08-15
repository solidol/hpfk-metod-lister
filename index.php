<?php
session_start();

error_reporting(E_ERROR);
// -------------------------------------------------
// -------------------------------------------------
// -------------------------------------------------




require "./include/config.php";
require "./include/functions.php";

if (isset($_POST['username'])) {
    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['auth'] = true;
    } else {
        $_SESSION['auth'] = false;
    }
}

if (isset($_GET['logout'])){
    session_destroy();
    header('Location: /');
}


?>
<!doctype html>
<html lang="ua">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Методична база ХПФК</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/script.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/style.css" rel="stylesheet">


</head>

<body class="front">
    <div id="app">


        <main>
            <div class="container">
                <div class="row">
                    <h1>TestМетодична база Херсонського політехнічного фахового коледжу Національного університету "Одеська політехніка"</h1>
                </div>
                <div class="row">
                    <?php
                    if ($_SESSION['auth'] != true) {

                        include "./include/login-form.php";
                    } else {
                        include "./include/file-table.php";
                    } ?>
                    <?php
                    
                    ?>

                </div>
            </div>
        </main>
    </div>
</body>

</html>