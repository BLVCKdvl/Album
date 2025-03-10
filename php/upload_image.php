<?php
require __DIR__ . '/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album_id = intval($_POST['album_id']);
    $name = $_POST['imageName'];
    $description = $_POST['imageDescription'];
    $file = $_FILES['imageFile'];

    // Проверяем тип файла
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (!in_array($file['type'], $allowed_types)) {
        die("Ошибка: разрешены только изображения JPEG, JPG, PNG и GIF.");
    }

    // Указываем директорию для загрузки
    $upload_dir = '../images/';

    // Создаем директорию, если она не существует
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Генерируем уникальное имя файла
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = uniqid() . '.' . $file_extension;
    $file_path = $upload_dir . $file_name;

    // Перемещаем файл в указанную директорию
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        // Добавляем картинку в таблицу `images`
        $sql = "INSERT INTO images (album_id, name, description, file_path) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . mysqli_error($connection));
        }

        mysqli_stmt_bind_param($stmt, 'isss', $album_id, $name, $description, $file_path);

        if (mysqli_stmt_execute($stmt)) {
            // Получаем ID только что добавленной картинки
            $image_id = mysqli_insert_id($connection);

            // Добавляем запись в таблицу `likes` (по умолчанию 0 лайков)
            $likes_sql = "INSERT INTO likes (image_id, likes) VALUES (?, 0)";
            $likes_stmt = mysqli_prepare($connection, $likes_sql);

            if (!$likes_stmt) {
                die("Ошибка подготовки запроса для likes: " . mysqli_error($connection));
            }

            mysqli_stmt_bind_param($likes_stmt, 'i', $image_id);
            if (!mysqli_stmt_execute($likes_stmt)) {
                die("Ошибка при добавлении в таблицу likes: " . mysqli_error($connection));
            }
            mysqli_stmt_close($likes_stmt);

            // Добавляем запись в таблицу `comments` (пустой комментарий)
            $comments_sql = "INSERT INTO comments (image_id, text) VALUES (?, '')";
            $comments_stmt = mysqli_prepare($connection, $comments_sql);

            if (!$comments_stmt) {
                die("Ошибка подготовки запроса для comments: " . mysqli_error($connection));
            }

            mysqli_stmt_bind_param($comments_stmt, 'i', $image_id);
            if (!mysqli_stmt_execute($comments_stmt)) {
                die("Ошибка при добавлении в таблицу comments: " . mysqli_error($connection));
            }
            mysqli_stmt_close($comments_stmt);

            // Перенаправляем пользователя на страницу альбома
            header("Location: ../album.php?id=$album_id");
            exit();
        } else {
            echo "Ошибка при сохранении в базу данных: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Ошибка при загрузке файла.";
    }
}
?>