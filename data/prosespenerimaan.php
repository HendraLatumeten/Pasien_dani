<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
//    $test[] = array(
//        data => array()
//    );
    if(isset($_GET['iddaftar'])){$iddaftar = $_GET['iddaftar'];} else {$iddaftar = $_POST['iddaftar'];}
    $count = count($iddaftar);
    for($i=0; $i<=$count; $i++){
        $jml = ($i/$count) * 100;
        $query = "Update pendaftaran set idstatus = '2' "
            . "Where iddaftar = '$iddaftar[$i]'";
        $result = mysql_query($query);
        $test[] = array(
            "total" => $jml
        );
    }
    echo json_encode($test);
?>