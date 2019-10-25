<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idhasil'])){$idhasil = $_GET['idhasil'];} else {$idhasil = $_POST['idhasil'];}
        if(isset($_GET['namahasil'])){$namahasil = $_GET['namahasil'];} else {$namahasil = $_POST['namahasil'];}
        $query = "Update penghasilan set namahasil = '$namahasil' "
            . "Where idhasil = '$idhasil'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idhasil = getMax('idhasil', 'penghasilan');
        if(isset($_GET['namahasil'])){$namahasil = $_GET['namahasil'];} else {$namahasil = $_POST['namahasil'];}
        $query = "Insert Into penghasilan values('$idhasil', '$namahasil')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idhasil = $_GET['id'];} else {$idhasil = $_POST['id'];}
        $query = "Delete From penghasilan Where idhasil = '$idhasil'";
        $result = mysql_query($query);
        if($result){
            header("location:../penghasilan");
        }else{
            header("location:../penghasilan");
        }
    }?>