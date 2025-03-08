<?php
    require 'php/db_connect.php';

    $album_id = $GET['id'];

    $sql_album = "SELECT * FROM albums WHERE id = $album_id";
    $result_album = mysqli_query($conn, $sql_album);
    $album = mysqli_fetch_assoc($result_album);

    $sql_images = "SELECT * FROM images WHERE album_id = $album_id";
    $result_images = mysqli_query($conn, $sql_images);

    $images = [];
    while ($row = mysqli_fetch_assoc($result_images)) 
    {
        $images[] = $row;
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Альбом</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 id="album-title" align="center">Название альбома</h1>
        <div id="images-list">

            <!-- TODO: изображения -->

            <form action="php/upload_image.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="album_id" value="<?php echo $album_id?>"
                <label for="image_name">Название изображения:</label>
                <input type="text" name="image_name" id="image_name" required>
                <br>
                <label for="image_description">Описание изображения:</label>
                <textarea name="image_description" id="image_description"></textarea>
                <br>
                <label for="image_file">Выберите файл:</label>
                <input type="file" name="image_file" id="image_file" required>
                <br>
                <button type="submit">Загрузить</button>
            </form>
        </div>
        <button id="add-image-btn">Добавить изображение</button>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>