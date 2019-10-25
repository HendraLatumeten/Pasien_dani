<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idkerja'])){$idkerja = $_GET['idkerja'];} else {$idkerja = $_POST['idkerja'];}
        if(isset($_GET['namakerja'])){$namakerja = $_GET['namakerja'];} else {$namakerja = $_POST['namakerja'];}
        $query = "Update pekerjaan set namakerja = '$namakerja' "
            . "Where idkerja = '$idkerja'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        if(isset($_GET['idkerja'])){$idkerja = $_GET['idkerja'];} else {$idkerja = $_POST['idkerja'];}
        if(isset($_GET['namakerja'])){$namakerja = $_GET['namakerja'];} else {$namakerja = $_POST['namakerja'];}
        $query = "Insert Into pekerjaan values('$idkerja', '$namakerja')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idkerja = $_GET['id'];} else {$idkerja = $_POST['id'];}
        $query = "Delete From pekerjaan Where idkerja = '$idkerja'";
        $result = mysql_query($query);
        if($result){
            header("location:../pekerjaan");
        }else{
            header("location:../pekerjaan");
        }
    }?>