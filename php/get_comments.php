<?php
require 'db_connect.php';

header('Content-Type: application/json');

$image_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($image_id > 0) {
    $sql = "SELECT text FROM comments WHERE image_id = ? AND text IS NOT NULL AND text <> ''";
    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса']);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'i', $image_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row['text'];
    }

    echo json_encode(['comments' => $comments]);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Неверный ID изображения']);
}

mysqli_close($connection);
?>
