<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album_id = intval($_POST['album_id']);

    // Проверяем, есть ли изображения в альбоме
    $sql = "SELECT COUNT(*) as count FROM images WHERE album_id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $album_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $image_count = $row['count'];
    mysqli_stmt_close($stmt);

    if ($image_count == 0) {
        $sql = "DELETE FROM albums WHERE id = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $album_id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: /index.php"); 
            exit;
        } else {
            echo "Ошибка при удалении альбома: " . mysqli_error($connection);
        }
    } else {
        echo "Альбом не пустой. Удаление запрещено.";
    }
} else {
    echo "Неверный метод запроса.";
}
?>