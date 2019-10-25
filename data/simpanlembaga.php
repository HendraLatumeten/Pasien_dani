<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idlembaga'])){$idlembaga = $_GET['idlembaga'];} else {$idlembaga = $_POST['idlembaga'];}
        if(isset($_GET['namalembaga'])){$namalembaga = $_GET['namalembaga'];} else {$namalembaga = $_POST['namalembaga'];}
        if(isset($_GET['keteranganlembaga'])){$keteranganlembaga = $_GET['keteranganlembaga'];} else {$keteranganlembaga = $_POST['keteranganlembaga'];}
        $query = "Update lembaga set namalembaga = '$namalembaga', keteranganlembaga = '$keteranganlembaga' "
            . "Where idlembaga = '$idlembaga'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idlembaga = getMax('idlembaga', 'lembaga');
        if(isset($_GET['namalembaga'])){$namalembaga = $_GET['namalembaga'];} else {$namalembaga = $_POST['namalembaga'];}
        if(isset($_GET['keteranganlembaga'])){$keteranganlembaga = $_GET['keteranganlembaga'];} else {$keteranganlembaga = $_POST['keteranganlembaga'];}
        $query = "Insert Into lembaga values('$idlembaga', '$namalembaga', '$keteranganlembaga')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idlembaga = $_GET['id'];} else {$idlembaga = $_POST['id'];}
        $query = "Delete From lembaga Where idlembaga = '$idlembaga'";
        $result = mysql_query($query);
        if($result){
            header("location:../lembaga");
        }else{
            header("location:../lembaga");
        }
    }?>