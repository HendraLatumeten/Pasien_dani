<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['idkhusus'])){$idkhusus = $_GET['idkhusus'];} else {$idkhusus = $_POST['idkhusus'];}
        if(isset($_GET['namakhusus'])){$namakhusus = $_GET['namakhusus'];} else {$namakhusus = $_POST['namakhusus'];}
        if(isset($_GET['poinkhusus'])){$poinkhusus = $_GET['poinkhusus'];} else {$poinkhusus = $_POST['poinkhusus'];}
        $query = "Update kebutuhankhusus set namakhusus = '$namakhusus', poinkhusus = '$poinkhusus' "
            . "Where idkhusus = '$idkhusus'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $idkhusus = getMax('idkhusus', 'kebutuhankhusus');
        if(isset($_GET['namakhusus'])){$namakhusus = $_GET['namakhusus'];} else {$namakhusus = $_POST['namakhusus'];}
        if(isset($_GET['poinkhusus'])){$poinkhusus = $_GET['poinkhusus'];} else {$poinkhusus = $_POST['poinkhusus'];}
        $query = "Insert Into kebutuhankhusus values('$idkhusus', '$namakhusus', '$poinkhusus')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$idkhusus = $_GET['id'];} else {$idkhusus = $_POST['id'];}
        $query = "Delete From kebutuhankhusus Where idkhusus = '$idkhusus'";
        $result = mysql_query($query);
        if($result){
            header("location:../khusus");
        }else{
            header("location:../khusus");
        }
    }?>