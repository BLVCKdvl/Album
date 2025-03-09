<?php
    require 'php/db_connect.php';

    $sql = "SELECT * FROM albums";
    $result = mysqli_query($connection, $sql);

    $albums = [];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $album_id = $row['id'];
        $image_sql = "SELECT file_path FROM images WHERE album_id=$album_id LIMIT 1";
        $image_result = mysqli_query($connection, $image_sql);
        $image = mysqli_fetch_assoc($image_result);

        $row['thumbnail_path'] = $image ? $image['file_path'] : 'images/default_thumbnail.jpg';
        $albums[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Альбомы</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 align="center">Список альбомов</h1>

        <div class="albums-list">
            <?php foreach ($albums as $album): ?>
                <a href="album.php?id=<?php echo $album['id']; ?>" class="album-link">
                    <div class='album'>
                        <img src="<?php echo $album['thumbnail_path']; ?>" alt="<?php echo $album['name'] ?>" class="album-thumbnail">
                        <h3><?php echo $album['name']; ?></h3>   
                    </div>
                </a>                
            <?php endforeach; ?>

            <div class="create-album" onclick="openModal()">
                <span>+ Создать альбом</span>
            </div>
        </div>        
    </div>

    <?php include 'components/modal.html'; ?>
    
    <script src="js/scripts.js"></script>
    <script src="js/modal.js"></script>
</body>
</html>