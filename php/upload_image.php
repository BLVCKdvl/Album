<?php
require 'db_connect.php';

// Проверяем, был ли отправлен файл
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image_file'])) {
    $album_id = $_POST['album_id'];
    $image_name = $_POST['image_name'];
    $image_description = $_POST['image_description'];

    // Проверяем, что все поля заполнены
    if (empty($album_id) || empty($image_name) || empty($_FILES['image_file']['name'])) {
        die("Ошибка: все поля должны быть заполнены.");
    }

    // Проверяем, что файл был загружен без ошибок
    if ($_FILES['image_file']['error'] !== UPLOAD_ERR_OK) {
        die("Ошибка при загрузке файла.");
    }

    // Проверяем тип файла
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = $_FILES['image_file']['type'];
    if (!in_array($file_type, $allowed_types)) {
        die("Ошибка: допустимы только файлы JPEG, PNG и GIF.");
    }

    // Проверяем размер файла (не больше 5 МБ)
    $max_size = 5 * 1024 * 1024; // 5 МБ
    if ($_FILES['image_file']['size'] > $max_size) {
        die("Ошибка: размер файла не должен превышать 5 МБ.");
    }

    // Генерируем уникальное имя для файла
    $file_extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
    $file_name = uniqid() . '.' . $file_extension;
    $upload_dir = 'images/uploaded_images/';
    $file_path = $upload_dir . $file_name;

    // Перемещаем файл в папку uploaded_images
    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $file_path)) {
        // Сохраняем информацию о файле в базе данных
        $sql = "INSERT INTO images (album_id, name, description, file_path) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'isss', $album_id, $image_name, $image_description, $file_path);

        if (mysqli_stmt_execute($stmt)) {
            echo "Изображение успешно загружено!";
        } else {
            echo "Ошибка при сохранении в базу данных: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Ошибка при загрузке файла.";
    }
} else {
    echo "Ошибка: файл не был загружен.";
}

mysqli_close($connection);
?>