<?php
require 'db_connect.php';

$image_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($image_id > 0) {
    // Получаем данные об изображении
    $sql = "SELECT * FROM images WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        die("Ошибка подготовки запроса: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, 'i', $image_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $image = mysqli_fetch_assoc($result); // Сохраняем данные изображения

    if (!$image) {
        http_response_code(404);
        echo json_encode(['error' => 'Изображение не найдено']);
        exit;
    }

    // Получаем количество лайков
    $likes = getLikesCount($image_id, $connection);

    // Получаем количество комментариев
    $comments = getCommentsCount($image_id, $connection);

    // Формируем ответ
    $response = [
        'file_path' => $image['file_path'],
        'name' => $image['name'],
        'description' => $image['description'],
        'likes' => $likes,
        'comments' => $comments     
    ];

    // Отправляем ответ в формате JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Неверный ID изображения']);
}

mysqli_close($connection);
?>


        