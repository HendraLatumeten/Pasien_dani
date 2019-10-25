<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idalasan'])){$idalasan = $_GET['idalasan'];} else {$idalasan = $_POST['idalasan'];}
        if(isset($_GET['namaalasan'])){$namaalasan = $_GET['namaalasan'];} else {$namaalasan = $_POST['namaalasan'];}
        $query = "Update alasan set namaalasan = '$namaalasan' "
            . "Where idalasan = '$idalasan'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idalasan = getMax('idalasan', 'alasan');
        if(isset($_GET['namaalasan'])){$namaalasan = $_GET['namaalasan'];} else {$namaalasan = $_POST['namaalasan'];}
        $query = "Insert Into alasan values('$idalasan', '$namaalasan')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idalasan = $_GET['id'];} else {$idalasan = $_POST['id'];}
        $query = "Delete From alasan Where idalasan = '$idalasan'";
        $result = mysql_query($query);
        if($result){
            header("location:../alasan");
        }else{
            header("location:../alasan");
        }
    }?>