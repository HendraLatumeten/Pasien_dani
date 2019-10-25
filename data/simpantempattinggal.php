<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idtempat'])){$idtempat = $_GET['idtempat'];} else {$idtempat = $_POST['idtempat'];}
        if(isset($_GET['namatempat'])){$namatempat = $_GET['namatempat'];} else {$namatempat = $_POST['namatempat'];}
        $query = "Update tempattinggal set namatempat = '$namatempat' "
            . "Where idtempat = '$idtempat'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        if(isset($_GET['idtempat'])){$idtempat = $_GET['idtempat'];} else {$idtempat = $_POST['idtempat'];}
        if(isset($_GET['namatempat'])){$namatempat = $_GET['namatempat'];} else {$namatempat = $_POST['namatempat'];}
        $query = "Insert Into tempattinggal values('$idtempat', '$namatempat')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idtempat = $_GET['id'];} else {$idtempat = $_POST['id'];}
        $query = "Delete From tempattinggal Where idtempat = '$idtempat'";
        $result = mysql_query($query);
        if($result){
            header("location:../tempattinggal");
        }else{
            header("location:../tempattinggal");
        }
    }?>