<?php
require 'db_connect.php';

$album_name = $_POST['album_id'];
$image_name = $_POST['image_name'];
$image_description = $_POST['image_description'];

if(isset($FILES['image_file']) && $FILES['image_file']['error'] === UPLOAD_ERR_OK)
{
    $upload_dir = 'images/uploaded_images/';
    $file_name = basename($FILES['image_file']['name']);
    $file_path = $upload_dir.uniqid().'_'.$file_name;;

    if(move_uploaded_file($FILES['image_file']['tmp_name'].$file_path))
    {
        $sql = "INSERT INTO images (album_id, name, description, file_path) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'isss', $album_id, $image_name, $image_description, $file_path);

        if (mysqli_stmt_execute($stmt))
        {
            echo "image uploaded successfully";
        }
        else
        {
            echo "error when updating the image";
        }        
    }
    else
    {
        echo "error: file wasn't been uploaded";
    }

    mysqli_close($conn);
}
?>