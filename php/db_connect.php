<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'Localhost1#';
    $database = 'albums';

    $connection = mysqli_connect($host, $user, $password, $database);

    if (!$connection)
    {
        die("Ошибка подключения: " +  mysqli_connect_error());
    }
?>