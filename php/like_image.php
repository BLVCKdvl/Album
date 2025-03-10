<?php
header('Content-Type: application/json'); 
require 'db_connect.php';

$data = json_decode(file_get_contents('php://input'), true);
$image_id = isset($data['image_id']) ? intval($data['image_id']) : 0;

if ($image_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'Неверный ID изображения']);
    exit;
}

try {

    $sql = "UPDATE likes SET likes = likes + 1 WHERE image_id = ?";
    $stmt = $connection->prepare($sql);

    if (!$stmt) {
        throw new Exception('Ошибка подготовки запроса: ' . $connection->error);
    }

    $stmt->bind_param('i', $image_id);
    $stmt->execute();

    $sql = "SELECT likes FROM likes WHERE image_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $image_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $likes = $result->fetch_assoc()['likes'];

    echo json_encode(['success' => true, 'likes' => $likes]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $connection->close();
}
?>