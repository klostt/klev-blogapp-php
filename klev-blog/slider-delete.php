<?php

    require "libs/vars.php";
    require "libs/functions.php";

    if(!isAdmin()) {
        header("location: unauthorize.php");
        exit;
    }

    $id = $_GET["id"];

    if (deleteSlider($id)) {
        $_SESSION['message'] = $id." id numaralı slider silindi.";
        $_SESSION['type'] = "danger";
    
        header('Location: admin-slider.php');
    } else {
        echo "hata";
    } 



?>
