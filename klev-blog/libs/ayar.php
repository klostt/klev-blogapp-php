<?php

    $server ="localhost";
    $username = "webpa_mysqluser";
    $password = "Blog2022*";
    $database = "webpanos_klevblogmysql";

    $connection = mysqli_connect($server, $username, $password, $database);
    mysqli_set_charset($connection, "UTF8");
    if(mysqli_connect_errno() > 0) {
        die("error: ".mysqli_connect_errno());
    }

?>