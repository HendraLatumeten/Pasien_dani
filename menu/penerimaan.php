<?php
    error_reporting(0);
    include "../config/connection.php";
    session_start();
    $namauser = $_SESSION['NamaUser'];
    $groupuser = $_SESSION['NamaGroup'];
    $photo = $_SESSION['Photo'];
    $groupid = $_SESSION['GroupId'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin SD</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="img/images.png" type="image/x-icon">
		<link rel="icon" href="img/images.png" type="image/x-icon">
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- jAlert -->
        <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/datatables/dataTables.tableTools_1.css" rel="stylesheet" type="text/css"/>
        <!-- Date Picker -->
        <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!--[if lt IE 9]>
            <script src="js/html5shiv.js" type="text/javascript"></script>
            <script src="js/respond.min.js" type="text/javascript"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <header class="header">
            <a href="home" class="logo">
                Admin SD
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $namauser?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $photo?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $namauser." - ".$groupuser?>
                                    </p>
                                </li>
<?php
    if($groupid != '0'){
?>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
<?php
    }
?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $photo?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p style="font-size: 12px">Selamat Datang, <?php echo $namauser?></p>
<?php
    if($groupid != '0'){
?>
                                    <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
<?php
    }
    else{
?>
                                    <a href="login"><i class="fa fa-circle text-success"></i>Silahkan login</a>
<?php
    }
?>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
<?php 
    include 'accessmenu.php';
?>
                    </ul>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Penerimaan
                        <small>Admin SD</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Entri</a></li>
                        <li class="active">Penerimaan</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Entri Penerimaan</h3>
                                </div>
                                <div class="box-body">
                                    <form id="penerimaanform" name="penerimaanform" role="form" class="form-horizontal"
                                        method="post" action="data/simpanpenerimaan.php?act=new">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="iddaftar" class="col-md-5 control-label input-sm">Id Pendaftaran</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control input-sm" id="iddaftar" name="iddaftar"
                                                            placeholder="Id Pendaftaran">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggaldaftar" class="col-md-5 control-label input-sm">Tanggal Daftar</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control input-sm" id="tanggaldaftar" name="tanggaldaftar"
                                                            placeholder="Tanggal Daftar" readonly value="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="namadaftar" class="col-md-5 control-label input-sm">Nama Pendaftar</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control input-sm" id="namadaftar" name="namadaftar"
                                                            placeholder="Nama Pendaftar" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="paud" class="col-md-5 control-label input-sm">Apakah pernah PAUD</label>
                                                    <div class="col-md-7">
                                                        <label class="control-label input-sm">
                                                            <input type="radio" id="paud1" name="paud" class="minimal" value="1"/>
                                                            Ya
                                                        </label>
                                                        <label class="control-label input-sm">
                                                            <input type="radio" id="paud2" name="paud" class="minimal" value="2"/>
                                                            Tidak
                                                        </label>
                                                        <br>
                                                        <em class="invalid" for="paud"></em>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tk" class="col-md-5 control-label input-sm">Apakah pernah TK</label>
                                                    <div class="col-md-7">
                                                        <label class="control-label input-sm">
                                                            <input type="radio" id="tk1" name="tk" class="minimal" value="1"/>
                                                            Ya
                                                        </label>
                                                        <label class="control-label input-sm">
                                                            <input type="radio" id="tk2" name="tk" class="minimal" value="2"/>
                                                            Tidak
                                                        </label>
                                                        <br>
                                                        <em class="invalid" for="tk"></em>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idhobi" class="col-md-5 control-label input-sm">Hobi</label>
                                                    <div class="col-md-4">
                                                        <select id="idhobi" name="idhobi" class="form-control input-sm">
<?php
    $linkhobi = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkhobi){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resulthobi = mysqli_query($linkhobi, "Select * From hobi")){
        $nbrow = mysqli_num_rows($resulthobi);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resulthobi, MYSQL_ASSOC)){
                $idhobi = $rec['idhobi'];
                $namahobi = $rec['namahobi'];
                echo "<option value=$idhobi>$namahobi</option>";
            }
        }
        mysqli_free_result($resulthobi);
    }
    mysqli_close($linkhobi);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idcita" class="col-md-5 control-label input-sm">Cita-Cita</label>
                                                    <div class="col-md-4">
                                                        <select id="idcita" name="idcita" class="form-control input-sm">
<?php
    $linkcita = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkcita){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultcita = mysqli_query($linkcita, "Select * From cita")){
        $nbrow = mysqli_num_rows($resultcita);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultcita, MYSQL_ASSOC)){
                $idcita = $rec['idcita'];
                $namacita = $rec['namacita'];
                echo "<option value=$idcita>$namacita</option>";
            }
        }
        mysqli_free_result($resultcita);
    }
    mysqli_close($linkcita);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="iddaftar" class="col-md-5 control-label input-sm">Nama Lengkap</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control input-sm" id="namadepan" name="namadepan"
                                                            placeholder="Nama Depan">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-sm" id="namabelakang" name="namabelakang"
                                                            placeholder="Nama Belakang">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idkelamin" class="col-md-5 control-label input-sm">Jenis Kelamin</label>
                                                    <div class="col-md-4">
                                                        <select id="idkelamin" name="idkelamin" class="form-control input-sm">
<?php
    $linkkelamin = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkkelamin){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultkelamin = mysqli_query($linkkelamin, "Select * From kelamin")){
        $nbrow = mysqli_num_rows($resultkelamin);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultkelamin, MYSQL_ASSOC)){
                $idkelamin = $rec['idkelamin'];
                $namakelamin = $rec['namakelamin'];
                echo "<option value=$idkelamin>$namakelamin</option>";
            }
        }
        mysqli_free_result($resultkelamin);
    }
    mysqli_close($linkkelamin);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nisn" class="col-md-5 control-label input-sm">NISN</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-sm" id="nisn" name="nisn"
                                                            placeholder="NISN" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nik" class="col-md-5 control-label input-sm">NIK</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control input-sm" id="nik" name="nik"
                                                            placeholder="NIK" maxlength="16">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempatlahir" class="col-md-5 control-label input-sm">Tempat Lahir</label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control input-sm" id="tempatlahir" name="tempatlahir"
                                                            placeholder="Tempat Lahir">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggallahir" class="col-md-5 control-label input-sm">Tanggal Lahir</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-sm" id="tanggallahir" name="tanggallahir"
                                                            placeholder="Tanggal lahir">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idagama" class="col-md-5 control-label input-sm">Agama</label>
                                                    <div class="col-md-4">
                                                        <select id="idagama" name="idagama" class="form-control input-sm">
<?php
    $linkagama = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkagama){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultagama = mysqli_query($linkagama, "Select * From agama")){
        $nbrow = mysqli_num_rows($resultagama);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultagama, MYSQL_ASSOC)){
                $idagama = $rec['idagama'];
                $namaagama = $rec['namaagama'];
                echo "<option value=$idagama>$namaagama</option>";
            }
        }
        mysqli_free_result($resultagama);
    }
    mysqli_close($linkagama);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idkhusus" class="col-md-5 control-label input-sm">Berkebutuhan Khusus</label>
                                                    <div class="col-md-4">
                                                        <select id="idkhusus" name="idkhusus" class="form-control input-sm">
<?php
    $linkkhusus = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkkhusus){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultkhusus = mysqli_query($linkkhusus, "Select * From kebutuhankhusus")){
        $nbrow = mysqli_num_rows($resultkhusus);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultkhusus, MYSQL_ASSOC)){
                $idkhusus = $rec['idkhusus'];
                $namakhusus = $rec['namakhusus'];
                echo "<option value=$idkhusus>$namakhusus</option>";
            }
        }
        mysqli_free_result($resultkhusus);
    }
    mysqli_close($linkkhusus);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kodedaftar" class="col-md-5 control-label input-sm">Kode Pendaftaran</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control input-sm" id="kodedaftar" name="kodedaftar"
                                                            placeholder="Kode Pendaftaran" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tahunajaran" class="col-md-5 control-label input-sm">Tahun Ajaran</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-sm" id="tahunajaran" name="tahunajaran"
                                                            placeholder="Tahun Ajaran" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlahsaudara" class="col-md-12 control-label input-sm"></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlahsaudara" class="col-md-5 control-label input-sm">Jumlah Saudara</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control input-sm" id="jumlahsaudara" name="jumlahsaudara"
                                                            placeholder="Jumlah Saudara">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat" class="col-md-5 control-label input-sm">Alamat</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control input-sm" id="alamat" name="alamat"
                                                            placeholder="Alamat Jalan">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rt" class="col-md-5 control-label input-sm"></label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control input-sm" id="rt" name="rt"
                                                            placeholder="RT">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-sm" id="rw" name="rw"
                                                            placeholder="RW">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="desa" class="col-md-5 control-label input-sm">Dusun</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control input-sm" id="desa" name="desa"
                                                            placeholder="Dusun">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelurahan" class="col-md-5 control-label input-sm">Kelurahan / Desa</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control input-sm" id="kelurahan" name="kelurahan"
                                                            placeholder="Kelurahan / Desa">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kecamatan" class="col-md-5 control-label input-sm">Kecamatan</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control input-sm input-sm" id="kecamatan" name="kecamatan"
                                                            placeholder="Kecamatan">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kodepos" class="col-md-5 control-label input-sm">Kode Pos</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-sm input-sm" id="kodepos" name="kodepos"
                                                            placeholder="Kode Pos" maxlength="5">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idtempat" class="col-md-5 control-label input-sm">Tempat Tinggal</label>
                                                    <div class="col-md-5">
                                                        <select id="idtempat" name="idtempat" class="form-control input-sm">
<?php
    $linktinggal = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linktinggal){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resulttinggal = mysqli_query($linktinggal, "Select * From tempattinggal")){
        $nbrow = mysqli_num_rows($resulttinggal);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resulttinggal, MYSQL_ASSOC)){
                $idtinggal = $rec['idtempat'];
                $namatinggal = $rec['namatempat'];
                echo "<option value=$idtinggal>$namatinggal</option>";
            }
        }
        mysqli_free_result($resulttinggal);
    }
    mysqli_close($linktinggal);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idtransportasi" class="col-md-5 control-label input-sm">Media Transportasi</label>
                                                    <div class="col-md-5">
                                                        <select id="idtransportasi" name="idtransportasi" class="form-control input-sm">
<?php
    $linktransportasi = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linktransportasi){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resulttransportasi = mysqli_query($linktransportasi, "Select * From transportasi")){
        $nbrow = mysqli_num_rows($resulttransportasi);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resulttransportasi, MYSQL_ASSOC)){
                $idtransportasi = $rec['idtransportasi'];
                $namatransportasi = $rec['namatransportasi'];
                echo "<option value=$idtransportasi>$namatransportasi</option>";
            }
        }
        mysqli_free_result($resulttransportasi);
    }
    mysqli_close($linktransportasi);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idkps" class="col-md-5 control-label input-sm">Penerima KPS/PKH/KIP</label>
                                                    <div class="col-md-2">
                                                        <select id="idkps" name="idkps" class="form-control input-sm">
<?php
    $linkkps = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkkps){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultkps = mysqli_query($linkkps, "Select * From kps")){
        $nbrow = mysqli_num_rows($resultkps);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultkps, MYSQL_ASSOC)){
                $idkps = $rec['idkps'];
                $namakps = $rec['namakps'];
                echo "<option value=$idkps>$namakps</option>";
            }
        }
        mysqli_free_result($resultkps);
    }
    mysqli_close($linkkps);
?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control input-sm input-sm" id="nokps" name="nokps"
                                                            placeholder="No KPS Diisi Jika Menerima KPS">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idnegara" class="col-md-5 control-label input-sm">Kewarganegaraan</label>
                                                    <div class="col-md-4">
                                                        <select id="idnegara" name="idnegara" class="form-control input-sm">
<?php
    $linknegara = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linknegara){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultnegara = mysqli_query($linknegara, "Select * From warganegara")){
        $nbrow = mysqli_num_rows($resultnegara);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultnegara, MYSQL_ASSOC)){
                $idnegara = $rec['idnegara'];
                $namanegara = $rec['namanegara'];
                echo "<option value=$idnegara>$namanegara</option>";
            }
        }
        mysqli_free_result($resultnegara);
    }
    mysqli_close($linknegara);
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="namanegara" class="col-md-5 control-label input-sm">Nama Negara</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control input-sm input-sm" id="namanegara" name="namanegara"
                                                            placeholder="Nama Negara Diisi Jika Warga Negara Asing">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <input id="addortu" name="addortu" class="btn btn-primary" onclick="addOrtu('addRow1');" 
                                                            type="button" value="Tambah Wali"/>
                                                    </div>
                                                </div>
                                                <div id="addRow1">
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>
                                                            <label for='idwali' class='col-md-5 control-label input-sm'>Wali</label>
                                                            <div class='col-md-3'>
                                                                <select id='idwali' name='idwali[]' class='form-control input-sm'>
<?php
    $linkwali = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkwali){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultwali = mysqli_query($linkwali, "Select * From wali")){
        $nbrow = mysqli_num_rows($resultwali);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultwali, MYSQL_ASSOC)){
                $idwali = $rec['idwali'];
                $namawali = $rec['namawali'];
                echo "<option value=$idwali>$namawali</option>";
            }
        }
        mysqli_free_result($resultwali);
    }
    mysqli_close($linkwali);
?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='namaortu' class='col-md-5 control-label input-sm'>Nama Wali</label>
                                                            <div class='col-md-7'>
                                                                <input type='text' class='form-control input-sm' id='namaortu' placeholder='Nama Wali'
                                                                    name='namaortu[]'>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='tahunlahir' class='col-md-5 control-label input-sm'>Tahun Lahir</label>
                                                            <div class='col-md-5'>
                                                                <input type='text' class='form-control input-sm' id='tahunlahir' placeholder='Tahun Lahir'
                                                                    name='tahunlahir[]'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>
                                                            <label for='idlembaga' class='col-md-5 control-label input-sm'>Pendidikan</label>
                                                                <div class='col-md-6'>
                                                                    <select id='idlembaga' name='idlembaga[]' class='form-control input-sm'>
<?php
    $linkpend = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkpend){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultpend = mysqli_query($linkpend, "Select * From lembaga")){
        $nbrow = mysqli_num_rows($resultpend);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultpend, MYSQL_ASSOC)){
                $idpend = $rec['idlembaga'];
                $namapend = $rec['namalembaga'];
                echo "<option value=$idpend>$namapend</option>";
            }
        }
        mysqli_free_result($resultpend);
    }
    mysqli_close($linkpend);
?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='idkerja' class='col-md-5 control-label input-sm'>Pekerjaan</label>
                                                                <div class='col-md-6'>
                                                                    <select id='idkerja' name='idkerja[]' class='form-control input-sm'>
<?php
    $linkkerja = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkkerja){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultkerja = mysqli_query($linkkerja, "Select * From pekerjaan")){
        $nbrow = mysqli_num_rows($resultkerja);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultkerja, MYSQL_ASSOC)){
                $idkerja = $rec['idkerja'];
                $namakerja = $rec['namakerja'];
                echo "<option value=$idkerja>$namakerja</option>";
            }
        }
        mysqli_free_result($resultkerja);
    }
    mysqli_close($linkkerja);
?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='idhasil' class='col-md-5 control-label input-sm'>Penghasilan</label>
                                                                <div class='col-md-6'>
                                                                    <select id='idhasil' name='idhasil[]' class='form-control input-sm'>
<?php
    $linkhasil = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkhasil){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resulthasil = mysqli_query($linkhasil, "Select * From penghasilan")){
        $nbrow = mysqli_num_rows($resulthasil);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resulthasil, MYSQL_ASSOC)){
                $idhasil = $rec['idhasil'];
                $namahasil = $rec['namahasil'];
                echo "<option value=$idhasil>$namahasil</option>";
            }
        }
        mysqli_free_result($resulthasil);
    }
    mysqli_close($linkhasil);
?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='idkhusus1' class='col-md-5 control-label input-sm'>Berkebutuhan Khusus</label>
                                                            <div class='col-md-4'>
                                                                <select id='idkhusus1' name='idkhusus1[]' class='form-control input-sm'>
<?php
    $linkkhusus1 = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkkhusus1){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultkhusus1 = mysqli_query($linkkhusus1, "Select * From kebutuhankhusus")){
        $nbrow = mysqli_num_rows($resultkhusus1);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultkhusus1, MYSQL_ASSOC)){
                $idkhusus1 = $rec['idkhusus'];
                $namakhusus1 = $rec['namakhusus'];
                echo "<option value=$idkhusus1>$namakhusus1</option>";
            }
        }
        mysqli_free_result($resultkhusus1);
    }
    mysqli_close($linkkhusus1);
?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='idkhusus1' class='col-md-5 control-label input-sm'></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min_1.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="js/plugins/datepicker/locales/bootstrap-datepicker.id.js" type="text/javascript"></script>
        <!-- jquery gritter -->
        <script src="js/plugins/jquery-gritter/jquery.gritter.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-alert/jquery.alerts.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-form/jquery-form.min.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <script>
            var count = 0;
            var limitcount = 2;
            var idwali = "";
            var idlembaga = "";
            var idkerja = "";
            var idhasil = "";
            var idkhusus = "";
            function addOrtu(divName){
                var test;
                var newdiv = document.createElement('div');
                if(count === limitcount){
                    jQuery.gritter.add({
                        title: 'Tambah Wali',
                        text: 'Tidak bisa tambah wali lagi!!',
                        sticky: false,
                        time: ''
                    });
                    $("#addortu").attr('disabled', true);
                }
                else{
                    test = "<div class='col-md-6'>";
                    test += "<div class='form-group'>";
                    test += "<label for='idwali' class='col-md-5 control-label input-sm'>Wali</label>";
                    test += "<div class='col-md-3'>";
                    test += "<select id='idwali"+count+"' name='idwali[]' class='form-control input-sm'>";
                    test += "</select>";
                    test += "</div>";
                    test += "</div>";
                    test += "<div class='form-group'>";
                    test += "<label for='namaortu' class='col-md-5 control-label input-sm'>Nama Wali</label>";
                    test += "<div class='col-md-7'>";
                    test += "<input type='text' class='form-control input-sm' id='namaortu' placeholder='Nama Wali'";
                    test += "name='namaortu[]'>";
                    test += "</div>";
                    test += "</div>";
                    test += "<div class='form-group'>";
                    test += "<label for='tahunlahir' class='col-md-5 control-label input-sm'>Tahun Lahir</label>";
                    test += "<div class='col-md-5'>";
                    test += "<input type='text' class='form-control input-sm' id='tahunlahir' placeholder='Tahun Lahir'";
                    test += "name='tahunlahir[]'>";
                    test += "</div>";
                    test += "</div>";
                    test += "</div>";
                    test += "<div class='col-md-6'>";
                    test += "<div class='form-group'>";
                    test += "<label for='idlembaga' class='col-md-5 control-label input-sm'>Pendidikan</label>";
                    test += "<div class='col-md-6'>";
                    test += "<select id='idlembaga"+count+"' name='idlembaga[]' class='form-control input-sm'>";
                    test += "</select>";
                    test += "</div>";
                    test += "</div>";
                    test += "<div class='form-group'>";
                    test += "<label for='idkerja' class='col-md-5 control-label input-sm'>Pekerjaan</label>";
                    test += "<div class='col-md-6'>";
                    test += "<select id='idkerja"+count+"' name='idkerja[]' class='form-control input-sm'>";
                    test += "</select>";
                    test += "</div>";
                    test += "</div>";
                    test += "<div class='form-group'>";
                    test += "<label for='idhasil' class='col-md-5 control-label input-sm'>Penghasilan</label>";
                    test += "<div class='col-md-6'>";
                    test += "<select id='idhasil"+count+"' name='idhasil[]' class='form-control input-sm'>";
                    test += "</select>";
                    test += "</div>";
                    test += "</div>";
                    test += "<div class='form-group'>";
                    test += "<label for='idkhusus1' class='col-md-5 control-label input-sm'>Berkebutuhan Khusus</label>";
                    test += "<div class='col-md-4'>";
                    test += "<select id='idkhusus1"+count+"' name='idkhusus1[]' class='form-control input-sm'>";
                    test += "</select>";
                    test += "</div>";
                    test += "</div>";
                    test += "<div class='form-group'>";
                    test += "<label for='idkhusus1' class='col-md-5 control-label input-sm'></label>";
                    test += "</div>";
                    test += "</div>";
                    count++;
                    newdiv.innerHTML = test;
                    document.getElementById(divName).appendChild(newdiv);
                    idwali = "";
                    idlembaga = "";
                    idkerja = "";
                    idhasil = "";
                    idkhusus = "";
                    idwali = 
<?php
    $linkwali1 = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkwali1){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultwali1 = mysqli_query($linkwali1, "Select * From wali")){
        $nbrow = mysqli_num_rows($resultwali1);
        $test = "'";
        $testu = "";
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultwali1, MYSQL_ASSOC)){
                $idwali1 = $rec['idwali'];
                $namawali1 = $rec['namawali'];
                //echo "<option value=$idwali1>$namawali1</option>";
                $testu .= "<option value=$idwali1>$namawali1</option>";
            }
        }
        mysqli_free_result($resultwali1);
    }
    mysqli_close($linkwali1);
    echo $test.$testu.$test;
?>
                    ;
                    idlembaga = 
<?php
    $linkpend1 = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkpend1){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultpend1 = mysqli_query($linkpend1, "Select * From lembaga")){
        $nbrow = mysqli_num_rows($resultpend1);
        $test = "'";
        $testu = "";
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultpend1, MYSQL_ASSOC)){
                $idpend1 = $rec['idlembaga'];
                $namapend1 = $rec['namalembaga'];
                //echo "<option value=$idpend1>$namapend1</option>";
                $testu .= "<option value=$idpend1>$namapend1</option>";
            }
        }
        mysqli_free_result($resultpend1);
    }
    mysqli_close($linkpend1);
    echo $test.$testu.$test;
?>
                    ;
                    idkerja = 
<?php
    $linkkerja1 = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkkerja1){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultkerja1 = mysqli_query($linkkerja1, "Select * From pekerjaan")){
        $nbrow = mysqli_num_rows($resultkerja1);
        $test = "'";
        $testu = "";
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultkerja1, MYSQL_ASSOC)){
                $idkerja1 = $rec['idkerja'];
                $namakerja1 = $rec['namakerja'];
                //echo "<option value=$idkerja1>$namakerja1</option>";
                $testu .= "<option value=$idkerja1>$namakerja1</option>";
            }
        }
        mysqli_free_result($resultkerja1);
    }
    mysqli_close($linkkerja1);
    echo $test.$testu.$test;
?>
                    ;
                    idhasil = 
<?php
    $linkhasil1 = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkhasil1){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resulthasil1 = mysqli_query($linkhasil1, "Select * From penghasilan")){
        $nbrow = mysqli_num_rows($resulthasil1);
        $test = "'";
        $testu = "";
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resulthasil1, MYSQL_ASSOC)){
                $idhasil1 = $rec['idhasil'];
                $namahasil1 = $rec['namahasil'];
                //echo "<option value=$idhasil1>$namahasil1</option>";
                $testu .= "<option value=$idhasil1>$namahasil1</option>";
            }
        }
        mysqli_free_result($resulthasil1);
    }
    mysqli_close($linkhasil1);
    echo $test.$testu.$test;
?>
                    ;
                    idkhusus = 
<?php
    $linkkhusus2 = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkkhusus2){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultkhusus2 = mysqli_query($linkkhusus2, "Select * From kebutuhankhusus")){
        $nbrow = mysqli_num_rows($resultkhusus2);
        $test = "'";
        $testu = "";
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultkhusus2, MYSQL_ASSOC)){
                $idkhusus2 = $rec['idkhusus'];
                $namakhusus2 = $rec['namakhusus'];
                //echo "<option value=$idkhusus2>$namakhusus2</option>";
                $testu .= "<option value=$idkhusus2>$namakhusus2</option>";
            }
        }
        mysqli_free_result($resultkhusus2);
    }
    mysqli_close($linkkhusus2);
    echo $test.$testu.$test;
?>
                    ;
                    $('#idwali0').empty();
                    $('#idwali0').append(idwali);
                    $('#idwali1').append(idwali);
                    $('#idwali2').append(idwali);
                    $('#idlembaga0').empty();
                    $('#idlembaga0').append(idlembaga);
                    $('#idlembaga1').append(idlembaga);
                    $('#idlembaga2').append(idlembaga);
                    $('#idkerja0').empty();
                    $('#idkerja0').append(idkerja);
                    $('#idkerja1').append(idkerja);
                    $('#idkerja2').append(idkerja);
                    $('#idhasil0').empty();
                    $('#idhasil0').append(idhasil);
                    $('#idhasil1').append(idhasil);
                    $('#idhasil2').append(idhasil);
                    $('#idkhusus10').empty();
                    $('#idkhusus10').append(idkhusus);
                    $('#idkhusus11').append(idkhusus);
                    $('#idkhusus12').append(idkhusus);
                }
            }
            jQuery(document).ready(function(){
                $('#tanggallahir').datepicker({
                    format: 'dd/mm/yyyy',
                    todayHighlight: true,
                    language:"id",
                    autoclose:true
                });
                
                jQuery('#iddaftar').keydown(function(e){
                    if(e.keyCode !== 9){
                        return;
                    }
                    else{
                        $('#kodedaftar').val("");
                        $('#tahunajaran').val("");
                        $('#namadaftar').val("");
                        $('#tanggaldaftar').val("");
                        $('#idpaud').val("");
                        $('#idtk').val("");
                        $('#idhobi').val("");
                        $('#idcita').val("");
                        $.ajax({
                            url: "data/getdatapenerimaan.php",
                            dataType: "html",
                            data: {
                                iddaftar: jQuery('#iddaftar').val(),
                                kode: 1
                            },
                            success: function(data){
                                if(data === "true"){
                                    $.ajax({
                                        url: "data/getdatapenerimaan.php",
                                        dataType: "json",
                                        data: {
                                            iddaftar: jQuery('#iddaftar').val(),
                                            kode: 2
                                        },
                                        success: function(data){
                                            jQuery.each(data.aaData, function(i, item){
                                                var kodedaftar = item["kodedaftar"];
                                                var tahunajaran = item["tahunajaran"];
                                                var namadaftar = item["namadaftar"];
                                                var tanggaldaftar = item["tanggaldaftar"];
                                                var idpaud = item["idpaud"];
                                                var idtk = item["idtk"];
                                                var idhobi = item["idhobi"];
                                                var idcita = item["idcita"];
                                                $('#kodedaftar').val(kodedaftar);
                                                $('#tahunajaran').val(tahunajaran);
                                                $('#namadaftar').val(namadaftar);
                                                $('#tanggaldaftar').val(tanggaldaftar);
                                                $('#idpaud option:selected').val(idpaud);
                                                //$('#idtk option:selected').val(idtk);
                                                $('input:radio[name="idtk"][value="'+idtk+'"]').attr('checked',true);
                                                $("#idhobi option[value="+idhobi+"]").prop("selected", true);
                                                $("#idcita option[value="+idcita+"]").prop("selected", true);
                                            });
                                        }
                                    });
                                }
                                else if(data === "false1"){
                                    jQuery.gritter.add({
                                        title: 'Pendaftaran Siswa',
                                        text: 'Status masih pendaftaran ....!!',
                                        sticky: false,
                                        time: ''
                                    });
                                    return false;
                                }
                                else if(data === "false2"){
                                    jQuery.gritter.add({
                                        title: 'Pendaftaran Siswa',
                                        text: 'pendaftaran siswa tidak diterima....!!',
                                        sticky: false,
                                        time: ''
                                    });
                                    return false;
                                }
                                else if(data === "false3"){
                                    jQuery.gritter.add({
                                        title: 'Pendaftaran Siswa',
                                        text: 'pendaftaran siswa sudah keluar....!!',
                                        sticky: false,
                                        time: ''
                                    });
                                    return false;
                                }
                                else{
                                    jQuery.gritter.add({
                                        title: 'Pendaftaran Siswa',
                                        text: 'Data Pendaftaran tidak ditemukan..!!',
                                        sticky: false,
                                        time: ''
                                    });
                                    return false;
                                }
                            }
                        });
                    }
                });
                
                jQuery('#penerimaanform').on('submit', function(e){
                    e.preventDefault();
                    jQuery(this).ajaxSubmit({
                        success: function(data){
                            if(data === 'true'){
                                jQuery.gritter.add({
                                    title: 'Penerimaan',
                                    text: 'Simpan Penerimaan Sukses',
                                    sticky: false,
                                    time: ''
                                });
                                $.alerts.dialogClass = 'alert-blue';
                                jAlert('Simpan Penerimaan Sukses', 'Konfirmasi', function(){
                                    $.alerts.dialogClass = null;
                                    jQuery('#penerimaanform').resetForm();
                                });
                            }
                            else if(data === 'false'){
                                jQuery.gritter.add({
                                    title: 'Penerimaan',
                                    text: 'Simpan Penerimaan Gagal',
                                    sticky: false,
                                    time: ''
                                });
                                $.alerts.dialogClass = 'alert-blue';
                                jAlert('Simpan Penerimaan Gagal', 'Konfirmasi', function(){
                                    $.alerts.dialogClass = null;
                                });
                            }
                            else if(data === 'false1'){
                                return false;
                            }
                            else{
                                jQuery.gritter.add({
                                    title: 'Penerimaan',
                                    text: 'Ada yang salah dengan web',
                                    sticky: false,
                                    time: ''
                                });
                                $.alerts.dialogClass = 'alert-blue';
                                jAlert('Ada yang salah dengan web', 'Konfirmasi', function(){
                                    $.alerts.dialogClass = null;
                                });
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>