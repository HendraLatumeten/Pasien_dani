<?php
    if($_SESSION['GroupId'] === null || $_SESSION['GroupId'] === ''){
        $_SESSION['NamaUser'] = "Tamu";
        $_SESSION['GroupId'] = 0;
        $_SESSION['NamaGroup'] = "Calon Peserta";
        $_SESSION['KeteranganGroup'] = "Calon Peserta";
        $_SESSION['IpAddress'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['ComputerName'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $_SESSION['Photo'] = $photo."User.png";
        $_SESSION['active'] = "home";
    }
?>