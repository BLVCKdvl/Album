<?php
require 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['album_id']) || empty($data['description'])) {
        echo json_encode(['success' => false, 'error' => 'Неверные данные.']);
        exit;
    }

    $album_id = intval($data['album_id']);
    $description = trim($data['description']);

    if (empty($description)) {
        echo json_encode(['success' => false, 'error' => 'Описание не может быть пустым.']);
        exit;
    }

    $sql = "UPDATE albums SET description = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Ошибка подготовки запроса: ' . mysqli_error($connection)]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'si', $description, $album_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Ошибка выполнения запроса: ' . mysqli_error($connection)]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['success' => false, 'error' => 'Неверный метод запроса.']);
}

mysqli_close($connection);
?>