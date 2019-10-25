<?php
    error_reporting(0);
    include "../config/connection.php";
    session_start();
    if(isset($_GET['id'])){$id = $_GET['id'];} else {$id = $_POST['id'];}
    if(isset($_GET['field'])){$field = $_GET['field'];} else {$field = $_POST['field'];}
    if(isset($_GET['table'])){$table = $_GET['table'];} else {$table = $_POST['table'];}
    $sql = "Select Count(*) from $table Where $field = '$id'";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $jml = $row[0];
    }
    if($jml > 0){echo "false";}else{echo "true";}
?>