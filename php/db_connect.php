<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'Localhost1#';
    $database = 'albums';

    $connection = mysqli_connect($host, $user, $password, $database);

    if (!$connection)
    {
        die("Ошибка подключения: " +  mysqli_connect_error());
    }

    function getLikesCount($image_id, $connection) {

        $sql = "SELECT likes FROM likes WHERE image_id = $image_id";
        $result = mysqli_query($connection, $sql);
    
        if (!$result) {
            die("Ошибка запроса: " . mysqli_error($connection));
        }
    
        $row = mysqli_fetch_assoc($result);
        return $row['likes'] ?? 0;
    }

    function getCommentsCount($image_id, $connection) {

        $sql = "SELECT COUNT(*) as count FROM comments WHERE image_id = $image_id AND text IS NOT NULL AND text <> ''";
        $result = mysqli_query($connection, $sql);
    
        if (!$result) {
            die("Ошибка запроса: " . mysqli_error($connection));
        }
    
        $row = mysqli_fetch_assoc($result);

        return $row['count'] ?? 0; 
    }
?>