<?php
    session_start();

    $email = trim(strip_tags(htmlspecialchars($_POST["email"])));
    $password = password_hash(trim(strip_tags(htmlspecialchars($_POST["password"]))), PASSWORD_DEFAULT);

    $db = new PDO('mysql:host=localhost;dbname=tasks','root','');
    $sql = "SELECT id FROM users WHERE email <=>:email";
    $result = $db->prepare($sql);
    $result->bindValue(':email', $email);
    $result->execute();
    $inputs = $result->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['error'] = false;

    if(count($inputs) > 0) {
        $_SESSION['error'] = true;
    } else {
        $sql = "INSERT INTO users (email,password) VALUES (:email,:password)";
        $result = $db->prepare($sql);
        $result->bindValue(':email', $email);
        $result->bindValue(':password', $password);
        $result->execute();
    }

    header("Location: /task_11.php");
    exit();
?>