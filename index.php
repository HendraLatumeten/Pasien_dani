<?php
    error_reporting(0);
    session_start();
    include "config/connection.php";
    include "config/function.php";
    include "checkuser.php";
    $getacc = $_GET['active'];
    if ($getacc == null){$getacc = $_SESSION[active];} else{$getacc = $_GET['active'];}
    if($getacc == 'home'){
        include "menu/index.php";
    }
    if($getacc == 'agama'){
        include "menu/agama.php";
    }
    if($getacc == 'kelamin'){
        include "menu/kelamin.php";
    }
    if($getacc == 'paud'){
        include "menu/paud.php";
    }
    if($getacc == 'tk'){
        include "menu/tk.php";
    }
    if($getacc == 'kps'){
        include "menu/kps.php";
    }
    if($getacc == 'status'){
        include "menu/status.php";
    }
    if($getacc == 'wali'){
        include "menu/wali.php";
    }
    if($getacc == 'warga'){
        include "menu/warganegara.php";
    }
    if($getacc == 'alasan'){
        include "menu/alasan.php";
    }
    if($getacc == 'cita'){
        include "menu/cita.php";
    }
    if($getacc == 'hobi'){
        include "menu/hobi.php";
    }
    if($getacc == 'khusus'){
        include "menu/khusus.php";
    }
    if($getacc == 'lembaga'){
        include "menu/lembaga.php";
    }
    if($getacc == 'pekerjaan'){
        include "menu/pekerjaan.php";
    }
    if($getacc == 'penghasilan'){
        include "menu/penghasilan.php";
    }
    if($getacc == 'tempattinggal'){
        include "menu/tempattinggal.php";
    }
    if($getacc == 'transportasi'){
        include "menu/transportasi.php";
    }
    if($getacc == 'pendaftaran'){
        include "menu/pendaftaran.php";
    }
    if($getacc == 'penerimaan'){
        include "menu/penerimaan.php";
    }
    if($getacc == 'proses'){
        include "menu/proses.php";
    }
    if($getacc == 'pendaftaran1'){
        include "menu/pendaftaran1.php";
    }
    if($getacc == 'testmasuk'){
        include "menu/testmasuk.php";
    }
    if($getacc == 'lappendaftaran'){
        include "menu/lappendaftaran.php";
    }
    if($getacc == 'lappenerimaan'){
        include "menu/lappenerimaan.php";
    }
    if($getacc == 'lappenolakan'){
        include "menu/lappenolakan.php";
    }
    if($getacc == 'groupuser'){
        include "menu/groupuser.php";
    }
    if($getacc == 'user'){
        include "menu/user.php";
    }
    if($getacc == 'akses'){
        include "menu/akses.php";
    }
?>