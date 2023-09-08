<?php
session_start();

error_reporting(E_ERROR);
// -------------------------------------------------
// -------------------------------------------------
// -------------------------------------------------




require "./include/config.php";
require "./include/conn.php";
require "./include/functions.php";


if (isset($_GET['logout'])) {
    var_dump($_GET['logout']);
    session_destroy();
    header('Location: /');
}



if (isset($_POST['username']) && isset($_POST['password'])) {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Отримання введених даних
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Пошук користувача за іменем
    $stmt = $conn->prepare('SELECT * FROM users WHERE `name` = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Перевірка пароля
    if ($user && password_verify($password, $user['password'])) {
        // Авторизація успішна
        $_SESSION['auth'] = true;
    } else {
        // Помилка авторизації
        $_SESSION['auth'] = false;
    }
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
                    <h1 align="center">Методична база</h1>
                    <h1 align="center">Херсонського політехнічного фахового коледжу</h1>
                    <h1 align="center">Національного університету "Одеська політехніка"</h1>
                    <h1 align="center"></h1>
                </div>

                <?php
                if ($_SESSION['auth'] != true) {

                    include "./include/login-form.php";
                } else {
                    include "./include/file-table.php";
                } ?>
                <?php

                ?>


            </div>
        </main>
    </div>
</body>

</html>