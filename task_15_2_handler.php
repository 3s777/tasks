<?php
if (!empty($_FILES['image'])) {

    $image_count = count($_FILES['image']['name']);

    for ($i=0; $i<$image_count; $i++) {
        $image = $_FILES['image']['name'][$i];
        if(!empty($image)) {
            $image_tmp_name = $_FILES['image']['tmp_name'][$i];
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
    }

    header("Location: /task_15_2.php");
    exit();
}; ?>