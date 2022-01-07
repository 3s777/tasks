<?php
if (!empty($_FILES['image'])) {
    $image = $_FILES['image']['name'];
    if(!empty($image)) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $uploaded_file_name = uniqid();
        $full_uploaded_file_name = $uploaded_file_name.".".$extension;
        move_uploaded_file($image_tmp_name, "img/demo/gallery/".$full_uploaded_file_name);

        $db = new PDO('mysql:host=localhost;dbname=tasks','root','');
        $sql = "INSERT INTO images (image) VALUES (:image)";
        $result = $db->prepare($sql);
        $result->bindValue(':image', $full_uploaded_file_name);
        $result->execute();
    }

    header("Location: /task_15.php");
    exit();
}; ?>