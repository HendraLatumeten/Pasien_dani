<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../config/connection.php';
    include '../config/function.php';
    $action = $_GET['act'];
    if($action === 'new'){
        $idterima = getMax('idterima', 'penerimaan');
        $kdterima = getcode('idterima', 'penerimaan', 4);
        $tglterima = date('Y-m-d');
        if(isset($_GET['iddaftar'])){$iddaftar = $_GET['iddaftar'];} else {$iddaftar = $_POST['iddaftar'];}
        if(isset($_GET['tahunajaran'])){$tahunajaran = $_GET['tahunajaran'];} else {$tahunajaran = $_POST['tahunajaran'];}
        if(isset($_GET['namadepan'])){$namadepan = $_GET['namadepan'];} else {$namadepan = $_POST['namadepan'];}
        if(isset($_GET['namabelakang'])){$namabelakang = $_GET['namabelakang'];} else {$namabelakang = $_POST['namabelakang'];}
        if(isset($_GET['idkelamin'])){$idkelamin = $_GET['idkelamin'];} else {$idkelamin = $_POST['idkelamin'];}
        if(isset($_GET['nisn'])){$nisn = $_GET['nisn'];} else {$nisn = $_POST['nisn'];}
        if(isset($_GET['nik'])){$nik = $_GET['nik'];} else {$nik = $_POST['nik'];}
        if(isset($_GET['tempatlahir'])){$tempatlahir = $_GET['tempatlahir'];} else {$tempatlahir = $_POST['tempatlahir'];}
        if(isset($_GET['tanggallahir'])){$tanggallahir = $_GET['tanggallahir'];} else {$tanggallahir = $_POST['tanggallahir'];}
        if(isset($_GET['jumlahsaudara'])){$jumlahsaudara = $_GET['jumlahsaudara'];} else {$jumlahsaudara = $_POST['jumlahsaudara'];}
        if(isset($_GET['idagama'])){$idagama = $_GET['idagama'];} else {$idagama = $_POST['idagama'];}
        if(isset($_GET['idkhusus'])){$idkhusus = $_GET['idkhusus'];} else {$idkhusus = $_POST['idkhusus'];}
        if(isset($_GET['alamat'])){$alamat = $_GET['alamat'];} else {$alamat = $_POST['alamat'];}
        if(isset($_GET['rt'])){$rt = $_GET['rt'];} else {$rt = $_POST['rt'];}
        if(isset($_GET['rw'])){$rw = $_GET['rw'];} else {$rw = $_POST['rw'];}
        if(isset($_GET['desa'])){$desa = $_GET['desa'];} else {$desa = $_POST['desa'];}
        if(isset($_GET['kelurahan'])){$kelurahan = $_GET['kelurahan'];} else {$kelurahan = $_POST['kelurahan'];}
        if(isset($_GET['kecamatan'])){$kecamatan = $_GET['kecamatan'];} else {$kecamatan = $_POST['kecamatan'];}
        if(isset($_GET['kodepos'])){$kodepos = $_GET['kodepos'];} else {$kodepos = $_POST['kodepos'];}
        if(isset($_GET['idtempat'])){$idtempat = $_GET['idtempat'];} else {$idtempat = $_POST['idtempat'];}
        if(isset($_GET['idtransportasi'])){$idtransportasi = $_GET['idtransportasi'];} else {$idtransportasi = $_POST['idtransportasi'];}
        if(isset($_GET['idkps'])){$idkps = $_GET['idkps'];} else {$idkps = $_POST['idkps'];}
        if(isset($_GET['nokps'])){$nokps = $_GET['nokps'];} else {$nokps = $_POST['nokps'];}
        if(isset($_GET['idnegara'])){$idnegara = $_GET['idnegara'];} else {$idnegara = $_POST['idnegara'];}
        if(isset($_GET['namanegara'])){$namanegara = $_GET['namanegara'];} else {$namanegara = $_POST['namanegara'];}
        $sql = "Insert Into penerimaan values("
                . "'$idterima', '$kdterima', '$iddaftar', '$tglterima', '$tahunajaran', '$namadepan', '$namabelakang', "
                . "'$idkelamin', '$nisn', '$nik', '$tempatlahir', '$tanggallahir', '$jumlahsaudara', '$idagama', "
                . "'$idkhusus', '$alamat', '$rt', '$rw', '$desa', '$kelurahan', '$kecamatan', '$kodepos', "
                . "'$idtempat', '$idtransportasi', '$idkps', '$nokps', '$idnegara', '$namanegara')";
        $resultsis = mysql_query($sql);
        if(!$resultsis){echo "false";}
        else{
            $idterima1 = $idterima;
            $nisn1 = $nisn;
            $idwali = $_POST['idwali'];
            $namaortu = $_POST['namaortu'];
            $tahunlahir = $_POST['tahunlahir'];
            $idlembaga = $_POST['idlembaga'];
            $idkerja = $_POST['idkerja'];
            $idhasil = $_POST['idhasil'];
            $idkhusus1 = $_POST['idkhusus1'];
            $countwali = count($idwali);
            for($i=0; $i<$countwali; $i++){
                $noortu = getMax('noortu', 'orangtua');
                $idterima1 = $idterima;
                $nisn1 = $nisn;
                $idwali1 = $idwali[$i];
                $namaortu1 = $namaortu[$i];
                $tahunlahir1 = $tahunlahir[$i];
                $idlembaga1 = $idlembaga[$i];
                $idkerja1 = $idkerja[$i];
                $idhasil1 = $idhasil[$i];
                $idkhusus11 = $idkhusus1[$i];
                $sqlw = "Insert Into orangtua values("
                    ."'$noortu', '$idterima1', '$nisn1', '$idwali1', '$namaortu1', '$tahunlahir1', '$idlembaga1', "
                    . "'$idkerja1', '$idhasil1', '$idkhusus11')";
                $resultw = mysql_query($sqlw);
            }
            if($resultw){echo "true";}else{echo "false";}
        }
    }
?>