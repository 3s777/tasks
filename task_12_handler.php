<?php
    session_start();
    $text = trim(strip_tags(htmlspecialchars($_POST["text"])));
    $_SESSION['massages'] .= '<div>'.$text.'</div>';
    header("Location: /task_12.php");
    exit();
?>