<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idgroup'])){$idgroup = $_GET['idgroup'];} else {$idgroup = $_POST['idgroup'];}
        if(isset($_GET['namagroup'])){$namagroup = $_GET['namagroup'];} else {$namagroup = $_POST['namagroup'];}
        if(isset($_GET['keterangangroup'])){$keterangangroup = $_GET['keterangangroup'];} else {$keterangangroup = $_POST['keterangangroup'];}
        $query = "Update groupuser set namagroup = '$namagroup', keterangangroup = '$keterangangroup' "
            . "Where idgroup = '$idgroup'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idgroup = getMax('idgroup', 'groupuser');
        if(isset($_GET['namagroup'])){$namagroup = $_GET['namagroup'];} else {$namagroup = $_POST['namagroup'];}
        if(isset($_GET['keterangangroup'])){$keterangangroup = $_GET['keterangangroup'];} else {$keterangangroup = $_POST['keterangangroup'];}
        $query = "Insert Into groupuser values('$idgroup', '$namagroup', '$keterangangroup')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idgroup = $_GET['id'];} else {$idgroup = $_POST['id'];}
        $query = "Delete From groupuser Where idgroup = '$idgroup'";
        $result = mysql_query($query);
        if($result){
            header("location:../groupuser");
        }else{
            header("location:../groupuser");
        }
    }?>