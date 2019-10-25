<?php
    include "../config/connection.php";
    if(isset($_GET['username'])){$username = $_GET['username'];} else {$username = $_POST['username'];}
    if(isset($_GET['password'])){$password = $_GET['password'];} else {$password = $_POST['password'];}
    function antiinjection($data){
       $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
       return $filter_sql;
    }
    $username = antiinjection($username);
    $password = antiinjection($password);
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if ($result = mysqli_query($link, "call GetUserLogin('$username', '$password')")) {
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                session_start();
                $_SESSION['UserId'] = $rec['iduser'];
                $_SESSION['IdDaftar'] = $rec['iddaftar'];
                $_SESSION['NamaUser'] = $rec['namauser'];
                $_SESSION['PassUser'] = $rec['passuser'];
                $_SESSION['NamaDepan'] = $rec['namadepan'];
                $_SESSION['NamaBelakang'] = $rec['namabelakang'];
                $_SESSION['Foto'] = $rec['gambar'];
                $_SESSION['Email'] = $rec['email'];
                $_SESSION['Password'] = $password;
                $_SESSION['GroupId'] = $rec['idgroup'];
                $_SESSION['NamaGroup'] = $rec['namagroup'];
                $_SESSION['KeteranganGroup'] = $rec['keterangangroup'];
                $_SESSION['IpAddress'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['ComputerName'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $_SESSION["SessionId"] = $rec['iduser'] . date('YmdHis');
                $_SESSION['active'] = "home";
                $_SESSION['caption'] = "Halaman Utama";
            }
            $tm=date("Y-m-d H:i:s");
            header('location:home');
        }
        else{
            session_start();
            $_SESSION['UserId'] = 0;
            $_SESSION['NamaUser'] = "";
            $_SESSION['PassUser'] = "";
            $_SESSION['NamaDepan'] = "";
            $_SESSION['NamaBelakang'] = "";
            $_SESSION['Foto'] = "";
            $_SESSION['Email'] = "";
            $_SESSION['Password'] = "";
            $_SESSION['GroupId'] = 5;
            $_SESSION['NamaGroup'] = "Peserta";
            $_SESSION['KeteranganGroup'] = "Peserta";
            $_SESSION['IpAddress'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['ComputerName'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $_SESSION["SessionId"] = 0 . date('YmdHis');
            $_SESSION['active'] = "home";
            $_SESSION['caption'] = "Halaman Utama";
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>