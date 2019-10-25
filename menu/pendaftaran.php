<?php
    error_reporting(0);
    include "../config/connection.php";
    session_start();
    $namauser = $_SESSION['NamaUser'];
    $groupuser = $_SESSION['NamaGroup'];
    $photo = $_SESSION['Photo'];
    $groupid = $_SESSION['GroupId'];
    function getno(){
        $sql = "Select IfNull(Max(iddaftar)+1, 1) from pendaftaran";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_row($result)) {
            $kode = $row[0];
        }
        return $kode;
    }
    $no = getno();
    function getkode(){
        $sql = "Select Concat('PD', LPad(IfNull(Max(iddaftar)+1, 1), 3, 0)) from pendaftaran";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_row($result)) {
            $kode = $row[0];
        }
        return $kode;
    }
    $kode = getkode();
    $tanggal = date('d-m-Y');
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
        <!-- daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
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
                        Pendaftaran
                        <small>Admin SD</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Entri</a></li>
                        <li class="active">Pendaftaran</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Entri Pendaftaran</h3>
                                </div>
                                <div class="box-body">
                                    <form id="pendaftaranform" name="pendaftaranform" role="form" class="form-horizontal"
                                        method="post" action="data/simpanpendaftaran.php?act=new" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggaldaftar" class="col-md-4 control-label">Tanggal Daftar</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" id="tanggaldaftar" name="tanggaldaftar"
                                                            placeholder="Tanggal Daftar" readonly value="<?php echo $tanggal?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kodedaftar" class="col-md-4 control-label">Kode Pendaftaran</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" id="kodedaftar" name="kodedaftar"
                                                            placeholder="Kode Pendaftaran" readonly value="<?php echo $kode?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="namadaftar" class="col-md-4 control-label">Nama Pendaftar</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="namadaftar" name="namadaftar"
                                                            placeholder="Nama Pendaftar">
                                                        <p class="help-block">Hanya nama depan atau nama panggilan</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="paud" class="col-md-4 control-label">Apakah pernah PAUD</label>
                                                    <div class="col-md-8">
                                                        <label class="control-label">
                                                            <input type="radio" id="paud1" name="paud" class="minimal" value="1"/>
                                                            Ya
                                                        </label>
                                                        <label class="control-label">
                                                            <input type="radio" id="paud2" name="paud" class="minimal" value="2"/>
                                                            Tidak
                                                        </label>
                                                        <br>
                                                        <em class="invalid" for="paud"></em>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tk" class="col-md-4 control-label">Apakah pernah TK</label>
                                                    <div class="col-md-8">
                                                        <label class="control-label">
                                                            <input type="radio" id="tk1" name="tk" class="minimal" value="1"/>
                                                            Ya
                                                        </label>
                                                        <label class="control-label">
                                                            <input type="radio" id="tk2" name="tk" class="minimal" value="2"/>
                                                            Tidak
                                                        </label>
                                                        <br>
                                                        <em class="invalid" for="tk"></em>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="formulir" class="col-md-4 control-label">Formulir</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" id="formulir" name="formulir"
                                                            placeholder="Formulir" readonly value="F-PD" style="text-align: center">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="iddaftar" class="col-md-4 control-label">Id Pendaftaran</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" id="iddaftar" name="iddaftar"
                                                            placeholder="Id Pendaftaran" readonly value="<?php echo $no?>"
                                                            style="text-align: right">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="idhobi" class="col-md-4 control-label">Hobi</label>
                                                    <div class="col-md-5">
                                                        <select id="idhobi" name="idhobi" class="form-control">
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
                                                    <label for="idcita" class="col-md-4 control-label">Cita-Cita</label>
                                                    <div class="col-md-5">
                                                        <select id="idcita" name="idcita" class="form-control">
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
                                            </div>
                                        </div>
                                        <div class="row">
                                            <br>
                                            <div class="col-md-12 help-block">
                                                <label for="keterangan" class="col-md-12">Nama User dari Nama Pendaftar & Password dari Kode Pendaftaran</label>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Data Pendaftaran</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="datapendaftaran" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center" style="width: 10%">No</th>
                                                <th class="center" style="width: 15%">Tahun Ajaran</th>
                                                <th style="width: 15%">Kode Pendaftaran</th>
                                                <th>Tanggal Daftar</th>
                                                <th style="width: 25%">Nama Pendaftar</th>
                                                <th style="width: 13%">Status Pendaftar</th>
                                                <th class="center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
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
        <!-- jquery gritter -->
        <script src="js/plugins/jquery-gritter/jquery.gritter.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-alert/jquery.alerts.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-form/jquery-form.min.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>

        <!-- datatables -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <script>
            function reloadTabel(oTbl){
                oTbl.fnClearTable();
                oTbl.fnDraw();
            }
            
            function getdelete(idalasan){
                $.alerts.dialogClass = 'alert-blue';
                $.alerts.okButton = 'Yes';
                $.alerts.cancelButton = 'No';
                jConfirm('Anda yakin menghapusnya ?', 'Konfirmasi', function(r){
                    if(r === true){
                        window.location = 'data/simpanpendaftaran.php?act=delete&id='+idalasan;
                    }
                    else{return false;}
                });
            }
            jQuery(document).ready(function(){
                function No(){
                    var iddaftar = document.getElementById('iddaftar');
                    var kodedaftar = document.getElementById('kodedaftar');
                    $.ajax({
                        dataType: 'json',
                        url: "data/maxpendaftaran.php",
                        type: "GET",
                        success: function(data){
                            $.each(data, function(i, n){
                                var iddaftar1 = n["iddaftar"];
                                var kodedaftar1 = n["kodedaftar"];
                                iddaftar.value = iddaftar1;
                                kodedaftar.value = kodedaftar1;
                            });
                        },
                        failure: function(){

                        }
                    });
                }
                
                var daftar;
                daftar = $("#pendaftaranform").validate({
                    rules:{
                        namadaftar:{required : true},
                        paud:{required : true},
                        tk:{required : true}
                    },
                    messages:{
                        namadaftar:{required: "Nama pendaftar harus diisi"},
                        paud:{required: "Pilih salah satu"},
                        tk:{required : "Pilih salah satu"}
                    },
                    highlight: function(element){
                      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    },
                    success: function(element){
                      jQuery(element).closest('.form-group').removeClass('has-error');
                    }
                });
                jQuery('#pendaftaranform').on('submit', function(e){
                    e.preventDefault();
                    if(jQuery('#namadaftar').val() === '' || jQuery('#paud').val() === '' || jQuery('#tk').val() === ''){
                        return false;
                    }
                    else{
                        jQuery(this).ajaxSubmit({
                            success: function(data){
                                if(data === 'true'){
                                    jQuery.gritter.add({
                                        title: 'Pendaftaran',
                                        text: 'Simpan Pendaftaran Sukses',
                                        sticky: false,
                                        time: ''
                                    });
                                    $.alerts.dialogClass = 'alert-blue';
                                    jAlert('Simpan Pendaftaran Sukses', 'Konfirmasi', function(){
                                        $.alerts.dialogClass = null;
                                        jQuery('#pendaftaranform').resetForm();
                                        reloadTabel(datapendaftaran);
                                        No();
                                    });
                                }
                                else if(data === 'false'){
                                    jQuery.gritter.add({
                                        title: 'Pendaftaran',
                                        text: 'Simpan Pendaftaran Gagal',
                                        sticky: false,
                                        time: ''
                                    });
                                    $.alerts.dialogClass = 'alert-blue';
                                    jAlert('Simpan Pendaftaran Gagal', 'Konfirmasi', function(){
                                        $.alerts.dialogClass = null;
                                        No();
                                    });
                                }
                                else if(data === 'false1'){
                                    return false;
                                }
                                else{
                                    jQuery.gritter.add({
                                        title: 'Pendaftaran',
                                        text: 'Ada yang salah dengan web',
                                        sticky: false,
                                        time: ''
                                    });
                                    $.alerts.dialogClass = 'alert-blue';
                                    jAlert('Ada yang salah dengan web', 'Konfirmasi', function(){
                                        $.alerts.dialogClass = null;
                                        No();
                                    });
                                }
                            }
                        });
                    }
                });
                var datapendaftaran;
                datapendaftaran = $("#datapendaftaran").dataTable({
                    "sDom": "<'row'<'box-body'<'top'T<'col-xs-6'l><'col-xs-12'f>>"+
                            "<'col-sm-12 col-lg-12 no-padding'rt><'bottom'<'col-sm-12'ip>>"+
                            "<'clear'>",
                    "bPaginate": true,
                    "iDisplayLength": 10,
                    "bProcessing": false,
                    "bServerSide": true,
                    "sAjaxSource": "data/datapendaftaran.php",
                    "oLanguage": {
                        "sZeroRecords": "Tidak ada data yang cocok dengan kriteria pencarian anda",
                        "sLengthMenu": "Tampilkan _MENU_ data per halaman",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "sInfoEmpty": "Tampil 0 sampai 0 dari 0 data",
                        "sInfoFiltered": "(menyaring dari _MAX_ total data)",
                        "sSearch":"Cari"
                    },
                    "aoColumns": [
                        {"bSortable": false, "sClass": "center", "mData": "no"},
                        {"bSortable": false, "sClass": "center", "mData": "tahunajaran"},
                        {"bSortable": false, "mData": "kodedaftar"},
                        {"bSortable": false, "mData": "tanggaldaftar"},
                        {"bSortable": false, "mData": "namadaftar"},
                        {"bSortable": false, "mData": "namastatus"},
                        {"bSortable": false, "sClass": "center", "fnRender": function(oObj){
                                return "<td>"+
                                       "<a href='editalasan-"+oObj.aData["Action"]+"' "+
                                        "data-toggle='modal' data-target='#remoteModal' data-backdrop='static' class=''>"+
                                        "<span class='glyphicon glyphicon-edit'></span></a>&nbsp"+
                                        '<a href='+"#"+' class="confirm" onclick="getdelete(\''+oObj.aData["Action"]+ '\')">'+
                                        "<span class='glyphicon glyphicon-trash'></span></a>"+
                                       "</td>";
                             }
                        }
                    ],
                    "fnDrawCallback": function( oSettings ){
                        jQuery('div#datapendaftaran_length select, div#datapendaftaran_filter input').addClass("form-control input-group");
                    },
                    "oTableTools": {
                        "aButtons": [
                            {
                                "sExtends": "xls",
                                "sTitle": "SD_XLS",
                                "sMessage": "SD XLS Export",
                                "sButtonText": "Excel",
                                "mColumns": "visible"
                            },
                            {
                                "sExtends": "pdf",
                                "sTitle": "SD_PDF",
                                "sPdfMessage": "SD PDF Export",
                                "sPdfSize": "tabloid",
                                "sPdfOrientation": "landscape"
                            },
                            {
                                "sExtends": "print",
                                "sMessage": "Di buat oleh SD <i>(tekan Esc to tutup)</i>"
                            }
                        ],
                        "sSwfPath": "swf/copy_csv_xls_pdf.swf"
                    }
                });
            });
        </script>
    </body>
</html>