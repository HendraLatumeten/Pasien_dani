<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idtransportasi'])){$idtransportasi = $_GET['idtransportasi'];} else {$idtransportasi = $_POST['idtransportasi'];}
        if(isset($_GET['namatransportasi'])){$namatransportasi = $_GET['namatransportasi'];} else {$namatransportasi = $_POST['namatransportasi'];}
        $query = "Update transportasi set namatransportasi = '$namatransportasi' "
            . "Where idtransportasi = '$idtransportasi'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idtransportasi = getMax('idtransportasi', 'transportasi');
        if(isset($_GET['namatransportasi'])){$namatransportasi = $_GET['namatransportasi'];} else {$namatransportasi = $_POST['namatransportasi'];}
        $query = "Insert Into transportasi values('$idtransportasi', '$namatransportasi')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idtransportasi = $_GET['id'];} else {$idtransportasi = $_POST['id'];}
        $query = "Delete From transportasi Where idtransportasi = '$idtransportasi'";
        $result = mysql_query($query);
        if($result){
            header("location:../transportasi");
        }else{
            header("location:../transportasi");
        }
    }?>