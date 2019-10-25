<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['iddaftar'])){$iddaftar = $_GET['iddaftar'];} else {$iddaftar = $_POST['iddaftar'];}
        if(isset($_GET['namadaftar'])){$namadaftar = $_GET['namadaftar'];} else {$namadaftar = $_POST['namadaftar'];}
        $query = "Update pendaftaran set namadaftar = '$namadaftar' "
            . "Where iddaftar = '$iddaftar'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $iddaftar = getMax('iddaftar', 'pendaftaran');
        $tahun = date('Y');
        $tahun1 = $tahun+1;
        $tahunajaran = $tahun."-".$tahun1;
        $tanggaldaftar = date('Y-m-d');
        if(isset($_GET['kodedaftar'])){$kodedaftar = $_GET['kodedaftar'];} else {$kodedaftar = $_POST['kodedaftar'];}
        if(isset($_GET['namadaftar'])){$namadaftar = $_GET['namadaftar'];} else {$namadaftar = $_POST['namadaftar'];}
        if(isset($_GET['paud'])){$idpaud = $_GET['paud'];} else {$idpaud = $_POST['paud'];}
        if(isset($_GET['tk'])){$idtk = $_GET['tk'];} else {$idtk = $_POST['tk'];}
        if(isset($_GET['idcita'])){$idcita = $_GET['idcita'];} else {$idcita = $_POST['idcita'];}
        if(isset($_GET['idhobi'])){$idhobi = $_GET['idhobi'];} else {$idhobi = $_POST['idhobi'];}
        if($idpaud == '' || $idtk == ''){echo "false1";}
        else{
            $query = "Insert Into pendaftaran values('$iddaftar', '$kodedaftar', '$tanggaldaftar', '$namadaftar', '5', "
                . "'$tahunajaran', '$idpaud', '$idtk', '$idhobi', '$idcita', '1')";
            $result = mysql_query($query);
            if($result){
                $iduser = getMax('iduser', 'userlogin');
                $passuser = md5($namadaftar.$kodedaftar);
                $sql = "Insert Into userlogin values('$iduser', '$iddaftar', '$namadaftar', '$passuser', "
                    . "'$namadaftar', null, null, null, 5)";
                $resultu = mysql_query($sql);
                if($resultu){echo "true";}else{echo "false";}
            }else{echo "false";}
        }
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$iddaftar = $_GET['id'];} else {$iddaftar = $_POST['id'];}
        $query = "Delete From pendaftaran Where iddaftar = '$iddaftar'";
        $result = mysql_query($query);
        if($result){
            $query1 = "Delete From userlogin Where iddaftar = '$iddaftar'";
            $resultu = mysql_query($query1);
            if($resultu){header("location:../pendaftaran");}else{header("location:../pendaftaran");}
        }else{
            header("location:../pendaftaran");
        }
    }?>