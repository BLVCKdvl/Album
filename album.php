<?php
require 'php/db_connect.php';

// Получаем ID альбома из URL
$album_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Запрос для получения данных альбома
$album_sql = "SELECT * FROM albums WHERE id = $album_id";
$album_result = mysqli_query($connection, $album_sql);
$album = mysqli_fetch_assoc($album_result);

// Запрос для получения изображений альбома
$images_sql = "SELECT * FROM images WHERE album_id = $album_id";
$images_result = mysqli_query($connection, $images_sql);
$images = [];
while ($row = mysqli_fetch_assoc($images_result)) {
    $images[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($album['name']); ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>
    <div class="container">
        <h1 align="center"><?php echo htmlspecialchars($album['name']); ?></h1>
        <p><?php echo htmlspecialchars($album['description']); ?></p>

        <!-- Кнопка для добавления нового изображения -->
        <button onclick="openUploadModal()">Добавить изображение</button>

        <div class="back-to-albums">
            <a href="index.php" class="back-button">← Вернуться к альбомам</a>
        </div>

        <!-- Список изображений -->
        <div class="images-grid">
            <?php foreach ($images as $image): ?>
                <div class="image-item" onclick="openImageModal(<?php echo $image['id']; ?>)">
                    <img src="<?php echo htmlspecialchars($image['file_path']); ?>" alt="<?php echo htmlspecialchars($image['name']); ?>">
                    <h3><?php echo htmlspecialchars($image['name']); ?></h3>
                    <p>Лайки: <?php echo getLikesCount($image['id']); ?></p>
                    <p>Комментарии: <?php echo getCommentsCount($image['id']); ?></p>

                    <!-- Кнопка удаления -->
                    <form action="php/delete_image.php" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить это изображение?');">
                        <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                        <input type="hidden" name="file_path" value="<?php echo $image['file_path']; ?>">
                        <input type="hidden" name="album_id" value="<?php echo $album_id; ?>">
                        <button type="submit" class="delete-button">Удалить изображение</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Модальное окно для просмотра изображения -->
    <?php include 'components/image_modal.html'; ?>

    <!-- Модальное окно для загрузки изображения -->
    <?php include 'components/upload_modal.html'; ?>

    <script src="js/scripts.js"></script>
</body>
</html>