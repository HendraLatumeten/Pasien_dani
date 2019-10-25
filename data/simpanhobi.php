<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idhobi'])){$idhobi = $_GET['idhobi'];} else {$idhobi = $_POST['idhobi'];}
        if(isset($_GET['namahobi'])){$namahobi = $_GET['namahobi'];} else {$namahobi = $_POST['namahobi'];}
        $query = "Update hobi set namahobi = '$namahobi' "
            . "Where idhobi = '$idhobi'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idhobi = getMax('idhobi', 'hobi');
        if(isset($_GET['namahobi'])){$namahobi = $_GET['namahobi'];} else {$namahobi = $_POST['namahobi'];}
        $query = "Insert Into hobi values('$idhobi', '$namahobi')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idhobi = $_GET['id'];} else {$idhobi = $_POST['id'];}
        $query = "Delete From hobi Where idhobi = '$idhobi'";
        $result = mysql_query($query);
        if($result){
            header("location:../hobi");
        }else{
            header("location:../hobi");
        }
    }?>