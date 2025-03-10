<?php
header('Content-Type: application/json'); 
require 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $data = json_decode(file_get_contents('php://input'), true);

    $image_id = isset($data['image_id']) ? intval($data['image_id']) : 0;
    $text = isset($data['text']) ? trim($data['text']) : '';

    if (empty($text)) {
        echo json_encode(['success' => false, 'error' => 'Комментарий не может быть пустым.']);
        exit;
    }

    $query = "INSERT INTO comments (image_id, text) VALUES (?, ?)";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Ошибка подготовки запроса: ' . mysqli_error($connection)]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "is", $image_id, $text);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Ошибка при добавлении комментария: ' . mysqli_error($connection)]);
    }

    mysqli_stmt_close($stmt);
} else {
   
    echo json_encode(['success' => false, 'error' => 'Неверный метод запроса.']);
}

mysqli_close($connection);
?>