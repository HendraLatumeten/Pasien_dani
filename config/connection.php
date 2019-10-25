<?php
    $host = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $database = "sd";
    $photo = "photo/";

    mysql_connect($host,$dbuser,$dbpassword) or die("Connection Failed");
    mysql_select_db($database) or die("Database Can't Opnened");

?>
