<?php
if (!empty($_GET['id'])) {
    $id = trim(strip_tags(htmlspecialchars($_GET["id"])));

    $db = new PDO('mysql:host=localhost;dbname=tasks','root','');
    $sql = "SELECT image FROM images WHERE id <=>:id";
    $result = $db->prepare($sql);
    $result->bindValue(':id', $id);
    $result->execute();
    $images = $result->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($images)) {
        foreach ($images as $image) {
            $path_image = 'img/demo/gallery/'.$image['image'];
            unlink($path_image);

            $sql = "DELETE FROM images WHERE id <=>:id";
            $result = $db->prepare($sql);
            $result->bindValue(':id', $id);
            $result->execute();
        }
    }

    header("Location: /task_15_1.php");
    exit();
}; ?>