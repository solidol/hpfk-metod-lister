<?php


try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ваш код для роботи з базою даних

} catch (PDOException $e) {
    // Обробка помилки підключення до бази даних
    echo "Помилка підключення до бази даних: " . $e->getMessage();
}
