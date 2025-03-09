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

    function getLikesCount($image_id) {
        global $connection;
        $sql = "SELECT COUNT(*) as count FROM likes WHERE image_id = $image_id";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    }

    function getCommentsCount($image_id) {
        global $connection;
        $sql = "SELECT COUNT(*) as count FROM comments WHERE image_id = $image_id";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    }
?>