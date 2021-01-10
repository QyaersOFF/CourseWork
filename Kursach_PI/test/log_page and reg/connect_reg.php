<?php

// Параметры для подключения
$db_host = "localhost"; 
$db_user = "root"; // Логин БД
$db_password = "password"; // Пароль БД
$db_base = 'TestSait'; // Имя БД

// Подключение к базе данных
$link = mysqli_connect($db_host,$db_user,$db_password,$db_base);

// Если есть ошибка соединения, выводим её и убиваем подключение
if ($link->connect_error) {
    die('Ошибка : ('. $link->connect_errno .') '. $link->connect_error);
}
?>