<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album_name = $_POST['album_name'];
    $album_description = $_POST['album_description'];

    if (empty($album_name) || empty($album_description)) {
        die("Ошибка: все поля должны быть заполнены.");
    }

    $sql = "INSERT INTO albums (name, description) VALUES (?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $album_name, $album_description);

    if (mysqli_stmt_execute($stmt)) {
        echo "Альбом успешно создан!";
        header('Location: ../index.php'); 
        exit;
    } else {
        echo "Ошибка при сохранении в базу данных: " . mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Ошибка: неверный метод запроса.";
}

mysqli_close($connection);
?>