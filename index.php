<?php
    require 'php/db_connect.php';
    $albums = [];
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
        <div id="albums-list">
            <?php foreach ($albums as $album): ?>
                <div class='album'>
                    <h3><? echo $album['name']; ?></h3>
                    <p><?php echo $album['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button id="create-album-btn">Создать альбом</button>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>