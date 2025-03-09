<?php
    require __DIR__ . '/db_connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $album_id = intval($_POST['album_id']);
        $name = $_POST['imageName'];
        $description = $_POST['imageDescription'];
        $file = $_FILES['imageFile'];

        // Проверка, что файл является изображением
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (!in_array($file['type'], $allowed_types)) {
            die("Ошибка: разрешены только изображения JPEG, JPG, PNG и GIF.");
        }
        // Папка для загрузки изображений
        $upload_dir = '../images/';

        // Создаем папку, если она не существует
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Генерация уникального имени файла
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = uniqid() . '.' . $file_extension; // Уникальное имя файла
        $file_path = $upload_dir . $file_name;



        // Сохранение файла
        if (move_uploaded_file($file['tmp_name'], $file_path)) 
        {
            // Сохранение данных в базу
            $sql = "INSERT INTO images (album_id, name, description, file_path) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'isss', $album_id, $name, $description, $file_path);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../album.php?id=$album_id");
            } else {
                echo "Ошибка при сохранении в базу данных: " . mysqli_error($connection);
            }
        } 
        else 
        {
            echo "Ошибка при загрузке файла.";
        }
    }
?>