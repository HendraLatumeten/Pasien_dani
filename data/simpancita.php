<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idcita'])){$idcita = $_GET['idcita'];} else {$idcita = $_POST['idcita'];}
        if(isset($_GET['namacita'])){$namacita = $_GET['namacita'];} else {$namacita = $_POST['namacita'];}
        $query = "Update cita set namacita = '$namacita' "
            . "Where idcita = '$idcita'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idcita = getMax('idcita', 'cita');
        if(isset($_GET['namacita'])){$namacita = $_GET['namacita'];} else {$namacita = $_POST['namacita'];}
        $query = "Insert Into cita values('$idcita', '$namacita')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idcita = $_GET['id'];} else {$idcita = $_POST['id'];}
        $query = "Delete From cita Where idcita = '$idcita'";
        $result = mysql_query($query);
        if($result){
            header("location:../cita");
        }else{
            header("location:../cita");
        }
    }?>