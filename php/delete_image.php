<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_id = intval($_POST['image_id']);
    $file_path = $_POST['file_path'];
    $album_id = intval($_POST['album_id']);

    // Начинаем транзакцию
    mysqli_begin_transaction($connection);

    try {
        // Удаляем комментарии, связанные с изображением
        $sql_comments = "DELETE FROM comments WHERE image_id = ?";
        $stmt_comments = mysqli_prepare($connection, $sql_comments);
        mysqli_stmt_bind_param($stmt_comments, 'i', $image_id);
        mysqli_stmt_execute($stmt_comments);

        // Удаляем лайки, связанные с изображением
        $sql_likes = "DELETE FROM likes WHERE image_id = ?";
        $stmt_likes = mysqli_prepare($connection, $sql_likes);
        mysqli_stmt_bind_param($stmt_likes, 'i', $image_id);
        mysqli_stmt_execute($stmt_likes);

        // Удаляем само изображение
        $sql_images = "DELETE FROM images WHERE id = ?";
        $stmt_images = mysqli_prepare($connection, $sql_images);
        mysqli_stmt_bind_param($stmt_images, 'i', $image_id);
        mysqli_stmt_execute($stmt_images);

        // Удаляем файл с сервера
        if (file_exists($file_path)) {
            unlink($file_path); // Удаляем файл
        }

        // Подтверждаем транзакцию
        mysqli_commit($connection);

        // Перенаправляем обратно на страницу альбома
        header("Location: ../album.php?id=$album_id");
        exit;
    } catch (Exception $e) {
        // Откатываем транзакцию в случае ошибки
        mysqli_rollback($connection);
        echo "Ошибка при удалении изображения: " . $e->getMessage();
    }

    // Закрываем подготовленные выражения
    mysqli_stmt_close($stmt_comments);
    mysqli_stmt_close($stmt_likes);
    mysqli_stmt_close($stmt_images);
} else {
    echo "Неверный метод запроса.";
}
?>