<?php
header('Content-Type: application/json'); // Указываем, что возвращаем JSON
require 'db_connect.php'; // Подключаемся к базе данных

// Проверяем, был ли отправлен POST-запрос
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из тела запроса
    $data = json_decode(file_get_contents('php://input'), true);

    // Извлекаем данные
    $image_id = isset($data['image_id']) ? intval($data['image_id']) : 0;
    $text = isset($data['text']) ? trim($data['text']) : '';

    // Проверяем, не пустой ли комментарий
    if (empty($text)) {
        echo json_encode(['success' => false, 'error' => 'Комментарий не может быть пустым.']);
        exit;
    }

    // Подготавливаем SQL-запрос
    $query = "INSERT INTO comments (image_id, text) VALUES (?, ?)";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Ошибка подготовки запроса: ' . mysqli_error($connection)]);
        exit;
    }

    // Привязываем параметры к запросу
    mysqli_stmt_bind_param($stmt, "is", $image_id, $text);

    // Выполняем запрос
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Ошибка при добавлении комментария: ' . mysqli_error($connection)]);
    }

    // Закрываем подготовленный запрос
    mysqli_stmt_close($stmt);
} else {
    // Если запрос не POST, возвращаем ошибку
    echo json_encode(['success' => false, 'error' => 'Неверный метод запроса.']);
}

// Закрываем соединение с базой данных
mysqli_close($connection);
?>