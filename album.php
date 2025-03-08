<?php
    require 'php/db_connect.php';

    $album_id = $_GET['id'];

    $sql_album = "SELECT * FROM albums WHERE id = $album_id";
    $result_album = mysqli_query($connection, $sql_album);
    $album = mysqli_fetch_assoc($result_album);

    $sql_images = "SELECT * FROM images WHERE album_id = $album_id";
    $result_images = mysqli_query($connection, $sql_images);

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
    <title><?php echo $album['name']; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 id="album-title" align="center"><?php echo $album['name']; ?></h1>
        <p id="album-description" align="center"><?php echo $album['description']; ?></p>

        <h2>Изображения</h2>
        <div id="images-list">
            <?php foreach ($images as $image): ?>
                <div class="image">

                    <img src="<?php echo $image['file_path']; ?>" alt="<?php echo $image['name']; ?>">
                    <h3><?php echo $image['name']; ?></h3>
                    <p> <?php echo $image['description']; ?> </p>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>Добавить изображение</h2>
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
    <script src="js/scripts.js"></script>
</body>
</html>