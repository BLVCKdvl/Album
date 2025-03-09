<?php
require 'php/db_connect.php';

$album_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$album_sql = "SELECT * FROM albums WHERE id = $album_id";
$album_result = mysqli_query($connection, $album_sql);
$album = mysqli_fetch_assoc($album_result);

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
</head>
<body>
    <div class="back-to-albums">
        <a href="index.php" class="back-button">← Вернуться к альбомам</a>
    </div>
    <div class="container">
        <h1 align="center"><?php echo htmlspecialchars($album['name']); ?></h1>
        <h4 id="album-description" align="center"><?php echo htmlspecialchars($album['description']); ?></h4>
        <div id="album-id" data-album-id="<?php echo $album_id; ?>" style="display: none;"></div>

        <?php
            $sql = "SELECT COUNT(*) as count FROM images WHERE album_id = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $album_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $image_count = $row['count'];
            mysqli_stmt_close($stmt);

            if ($image_count == 0): 
        ?>
            <form action="php/delete_album.php" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот альбом?');">
                <input type="hidden" name="album_id" value="<?php echo $album_id; ?>">
                <button type="submit" class="delete-album-button">Удалить пустой альбом</button>
            </form>
        <?php endif; ?>

        <div class="button-container">
            <button class="add-image-button" onclick="openUploadModal()">Добавить изображение</button>
            <button class="edit-description-button" onclick="openEditDescriptionModal()">Редактировать описание</button>            
        </div>
        
        

        <div class="images-grid">
            <?php foreach ($images as $image): ?>
                <div class="image-item" onclick="openImageModal(<?php echo $image['id']; ?>)">
                    <img src="<?php echo htmlspecialchars($image['file_path']); ?>" alt="<?php echo htmlspecialchars($image['name']); ?>">
                    <div class="image-information">
                    <h3><?php echo htmlspecialchars($image['name']); ?></h3>
                    <p>Лайки: <?php echo getLikesCount($image['id']); ?></p>
                    <p>Комментарии: <?php echo getCommentsCount($image['id']); ?></p>

                    <form action="php/delete_image.php" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить это изображение?');">
                        <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                        <input type="hidden" name="file_path" value="<?php echo $image['file_path']; ?>">
                        <input type="hidden" name="album_id" value="<?php echo $album_id; ?>">
                        <button type="submit" class="delete-button">Удалить изображение</button>
                    </form>
                    </div>                    
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'components/upload_modal.html'; ?>

    <?php include 'components/upload_description_modal.html'; ?>

    <script src="js/scripts.js"></script>
</body>
</html>