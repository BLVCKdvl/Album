<?php
    require 'php/db_connect.php';

    $sql = "SELECT * FROM albums";
    $result = mysqli_query($connection, $sql);

    $albums = [];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $albums[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Альбомы</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>
    <div class="container">
        <h1 align="center">Список альбомов</h1>

        <div class="albums-list">
            <?php foreach ($albums as $album): ?>
                <div class='album'>
                    <h3><?php echo $album['name']; ?></h3>   
                </div>
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