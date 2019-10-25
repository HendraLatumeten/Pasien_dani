<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'edit'){
        if(isset($_GET['iduser'])){$iduser = $_GET['iduser'];} else {$iduser = $_POST['iduser'];}
        if(isset($_GET['namauser'])){$namauser = $_GET['namauser'];} else {$namauser = $_POST['namauser'];}
        if(isset($_GET['passuser'])){$passuser = $_GET['passuser'];} else {$passuser = $_POST['passuser'];}
        if(isset($_GET['namadepan'])){$namadepan = $_GET['namadepan'];} else {$namadepan = $_POST['namadepan'];}
        if(isset($_GET['namabelakang'])){$namabelakang = $_GET['namabelakang'];} else {$namabelakang = $_POST['namabelakang'];}
        if(isset($_GET['idgroup'])){$idgroup = $_GET['idgroup'];} else {$idgroup = $_POST['idgroup'];}
        $sqlgetpass = "Select passuser from userlogin where iduser = '$iduser'";
        $resultpass = mysql_query($sqlgetpass);
        while($row = mysql_fetch_array($resultpass)){
            $passlama = $row['passuser'];
        }
        $PassLogin1 = $passuser;
        if($passlama === $PassLogin1){
            $NewPassLogin = $passlama;
        }
        else{
            $NewPassLogin = md5($namauser.$passuser);
        }
        $query = "Update userlogin set namauser = '$namauser', passuser = '$NewPassLogin', namadepan = '$namadepan', "
            . "namabelakang = '$namabelakang', idgroup = '$idgroup' Where iduser = '$iduser'";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'new'){
        $iduser = getMax('iduser', 'userlogin');
        if(isset($_GET['namauser'])){$namauser = $_GET['namauser'];} else {$namauser = $_POST['namauser'];}
        if(isset($_GET['passuser'])){$passuser = $_GET['passuser'];} else {$passuser = $_POST['passuser'];}
        if(isset($_GET['namadepan'])){$namadepan = $_GET['namadepan'];} else {$namadepan = $_POST['namadepan'];}
        if(isset($_GET['namabelakang'])){$namabelakang = $_GET['namabelakang'];} else {$namabelakang = $_POST['namabelakang'];}
        if(isset($_GET['idgroup'])){$idgroup = $_GET['idgroup'];} else {$idgroup = $_POST['idgroup'];}
        $PassUser = md5($namauser.$passuser);
        $query = "Insert Into userlogin(iduser, namauser, passuser, namadepan, namabelakang, idgroup, gambar) "
            . "values('$iduser', '$namauser', '$PassUser', '$namadepan', '$namabelakang', '$idgroup', 'User.png')";
        $result = mysql_query($query);
        if($result){echo "true";}else{echo "false";}
    }
    else if($action === 'delete'){
        if(isset($_GET['id'])){$iduser = $_GET['id'];} else {$iduser = $_POST['id'];}
        $query = "Delete From userlogin Where iduser = '$iduser'";
        $result = mysql_query($query);
        if($result){
            header("location:../user");
        }else{
            header("location:../user");
        }
    }
?>