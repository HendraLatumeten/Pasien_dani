<?php
    error_reporting(0);
    include "../config/connection.php";
    session_start();
    $namauser = $_SESSION['NamaUser'];
    $groupuser = $_SESSION['NamaGroup'];
    $photo = $_SESSION['Photo'];
    $groupid = $_SESSION['GroupId'];
    $iddaftar = $_SESSION['IdDaftar'];
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
        <link href="js/plugins/select2/select2/dist/css/select2.css" rel="stylesheet" type="text/css"/>
        <link href="js/plugins/select2/select2/docs/vendor/css/prettify.css" rel="stylesheet" type="text/css"/>
        <!-- jAlert -->
        <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
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
                        Proses Penerimaan
                        <small>Admin SD</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Entri</a></li>
                        <li class="active">Proses Penerimaan</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Proses Penerimaan</h3>
                                </div>
                                <div class="box-body">
                                    <form id="prosesform" name="prosesform" role="form" class="form-horizontal"
                                        method="post" action="data/prosespenerimaan.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="idaftar" class="col-md-2 control-label">Masukkan Peserta</label>
                                            <div class="col-md-8">
                                                <select id="iddaftar" name="iddaftar[]" class="form-control input-lg control-label" multiple>
                                                    <option value=''></option>
<?php
    $linkdaftar = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkdaftar){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultdaftar = mysqli_query($linkdaftar, "Select distinct h.iddaftar, namadaftar From hasiltest h, pendaftaran p "
        . "where p.iddaftar = h.iddaftar and p.idstatus < 2")){
        $nbrow = mysqli_num_rows($resultdaftar);
        if($nbrow>0){
            while($rec = mysqli_fetch_array($resultdaftar, MYSQL_ASSOC)){
                $iddaftar = $rec['iddaftar'];
                $namadaftar = $rec['namadaftar'];
                echo "<option value=$iddaftar>$namadaftar</option>";
            }
        }
        mysqli_free_result($resultdaftar);
    }
    mysqli_close($linkdaftar);
?>
                                                </select>
                                                <p class="help-block input-sm">Masukkan Peserta yang mau diproses</p>
                                            </div>
                                        </div>
                                        <div class="box box-primary">
                                            <div class="box-header">
                                                <h3 class="box-title">Data Peserta</h3>
                                            </div>
                                            <div class="box-body table-responsive">
                                                <table id="datadaftar" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Id Pendaftaran</th>
                                                            <th>Kode Pendaftaran</th>
                                                            <th>Nama Pendaftar</th>
                                                            <th>Status Pendaftar</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-primary" id="progress"></div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Proses</button>
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
        <script src="js/plugins/jquery-gritter/jquery.gritter.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-alert/jquery.alerts.js" type="text/javascript"></script>
        <script src="js/plugins/jquery-form/jquery-form.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/plugins/select2/select2/docs/vendor/js/placeholders.jquery.min.js"></script>
        <script src="js/plugins/select2/select2/dist/js/select2.full.js" type="text/javascript"></script>
        <script src="js/plugins/select2/select2/docs/vendor/js/prettify.min.js" type="text/javascript"></script>
        <script src="js/plugins/select2/select2/dist/js/i18n/id.js" type="text/javascript"></script>
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
            
            jQuery(document).ready(function(){
                $('#iddaftar').select2({
                    language:"id"
                });

                var datadaftar;
                datadaftar = $("#datadaftar").dataTable({
                    "sDom": "<'row'<'box-body'<'top'T<'col-xs-6'l><'col-xs-12'f>>"+
                            "<'col-sm-12 col-lg-12 no-padding'rt><'bottom'<'col-sm-12'ip>>"+
                            "<'clear'>",
                    "bPaginate": true,
                    "iDisplayLength": 10,
                    "bProcessing": false,
                    "bServerSide": true,
                    "sAjaxSource": "data/dataproses.php",
                    "oLanguage": {
                        "sZeroRecords": "Tidak ada data yang cocok dengan kriteria pencarian anda",
                        "sLengthMenu": "Tampilkan _MENU_ data per halaman",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "sInfoEmpty": "Tampil 0 sampai 0 dari 0 data",
                        "sInfoFiltered": "(menyaring dari _MAX_ total data)",
                        "sSearch":"Cari"
                    },
                    "aoColumns": [
                        {"bSortable": false, "sClass": "center", "mData": "No"},
                        {"bSortable": false, "sClass": "center", "mData": "iddaftar"},
                        {"bSortable": false, "mData": "kodedaftar"},
                        {"bSortable": false, "mData": "namadaftar"},
                        {"bSortable": false, "mData": "statusdaftar"}
                    ],
                    "fnDrawCallback": function( oSettings ){
                        jQuery('div#datadaftar_length select, div#datadaftar_filter input').addClass("form-control input-group");
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
                
                $('#prosesform').on('submit', function(e){
                    e.preventDefault();
                    $(this).ajaxSubmit({
                        success: function(data){
                            jQuery.each(eval(data.replace(/[\r\n]/, "")), function(i, n){
                                $("#progress").css('width',n["total"]+'%');
                                $("#progress").html(n["total"]+'%');                                
                            });
                            jQuery.gritter.add({
                                title: 'Proses Penerimaan',
                                text: 'Proses Penerimaan Sukses',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Proses Penerimaan Sukses', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                                $("#progress").css('width','0%');
                                $("#progress").html('0%');
                                $('#iddaftar').val('').change();
                                $('#iddaftar').select2('data', null);
                                reloadTabel(datadaftar);
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>