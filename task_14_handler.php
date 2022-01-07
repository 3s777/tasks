<?php
session_start();

$email = trim(strip_tags(htmlspecialchars($_POST["email"])));
$password = trim(strip_tags(htmlspecialchars($_POST["password"])));

$db = new PDO('mysql:host=localhost;dbname=tasks','root','');
$sql = "SELECT id,email,password FROM users WHERE email <=>:email";
$result = $db->prepare($sql);
$result->bindValue(':email', $email);
$result->execute();
$users = $result->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['error'] = false;

if(count($users) > 0) {
    foreach ($users as $user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $user['email'];
        } else {
            $_SESSION['error'] = true;
        }
    }
} else {
    $_SESSION['error'] = true;
}

if($_SESSION['error']) {
    header("Location: /task_14.php");
    exit();
} else {
    header("Location: /task_14_1.php");
    exit();
}

?>