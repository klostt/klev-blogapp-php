<?php
    
    require "libs/vars.php";
    require "libs/functions.php";
    if(!isAdmin()) {
        header("location: unauthorize.php");
        exit;
    }

    $id = $_GET["id"];

    if (deleteComment($id)) {
        $_SESSION['message'] = $id." id numaralı yorum silindi.";
        $_SESSION['type'] = "danger";
    
        header('Location: admin-comments.php');
    } else {
        echo "hata";
    } 



?>