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
                        Laporan Penerimaan
                        <small>Admin SD</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Laporan</a></li>
                        <li class="active">Laporan Penerimaan</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Laporan Penerimaan</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <form role="form" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="rangetanggal" class="control-label col-md-6">Tanggal</label>
                                                <div class="col-md-6">
                                                    <input id="rangetanggal" name="rangetanggal" 
                                                        class="form-control pull-right" type="text">
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-4"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table id="datalapterima" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Id Terima</th>
                                                        <th>Kode Terima</th>
                                                        <th>Tanggal Terima</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>NISN</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
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
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!--<script src="js/plugins/daterangepicker/moment-with-locales.js" type="text/javascript"></script>-->
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
                var tglawal = [], tglakhir = [];
                //moment().locale('id');
                //moment().locale()
                var datalapterima;
                datalapterima = $("#datalapterima").dataTable({
                    "sDom": "<'row'<'box-body'<'toolbar'><'top'T<'col-xs-6'l><'col-xs-12'f>>"+
                            "<'col-sm-12 col-lg-12 no-padding'rt><'bottom'<'col-sm-12'ip>>"+
                            "<'clear'>",
                    "bPaginate": true,
                    "iDisplayLength": 10,
                    "bProcessing": false,
                    "bServerSide": true,
                    "sAjaxSource": "data/datalapterima.php",
                    "fnServerParams": function (aoData) {
                        aoData.push({
                            "name": "tglawal", "value": tglawal
                        });
                        aoData.push({
                            "name": "tglakhir", "value": tglakhir
                        });
                    },
                    "oLanguage": {
                        "sZeroRecords": "Tidak ada data yang cocok dengan kriteria pencarian anda",
                        "sLengthMenu": "Tampilkan _MENU_ data per halaman",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "sInfoEmpty": "Tampil 0 sampai 0 dari 0 data",
                        "sInfoFiltered": "(menyaring dari _MAX_ total data)",
                        "sSearch":"Cari"
                    },
                    "fnDrawCallback": function( oSettings ){
                        jQuery('div#datalapterima_length select, div#datalapterima_filter input').addClass("form-control input-group");
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
                //moment.locale('id');
                $('#rangetanggal').daterangepicker({
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '31/12/2022',
                    dateLimit: { days: 60 },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'DD/MM/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        fromLabel: 'Dari',
                        format: 'dd/mm/yyyy',
                        toLabel: 'Sampai',
                        language:"id",
                        customRangeLabel: 'Custom Range',
                        daysOfWeek: ["Mg", "Sn", "Sl", "Ra", "Ka", "Ju", "Sa"],
                        monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'],
                        firstDay: 1
                    }
                },
                function(start, end) {
                    jQuery('#datalapterima span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
                    jQuery("div.toolbar").html('<b><center>LAPORAN PENERIMAAN</center></b>'+
                            '<br>'+
                            '<b><center>PERIODE '+start.format('D MMMM YYYY') + ' S/D ' + end.format('D MMMM YYYY')+
                            '</center></b><br>');
                    tglawal = start.format('YYYY-MM-DD');
                    tglakhir = end.format('YYYY-MM-DD');
                    reloadTabel(datalapterima);
                });
                jQuery('#datalapterima span').html(moment().subtract('days', 29).format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));
                jQuery("div.toolbar").html('<b><center>LAPORAN PENERIMAAN</center></b>'+
                        '<br>'+
                        '<b><center>PERIODE '+moment().subtract('days', 29).format('D MMMM YYYY') + ' S/D ' + 
                        moment().format('D MMMM YYYY')+'</center></b><br>');
                tglawal = moment().subtract('days', 29).format('YYYY-MM-DD');
                tglakhir = moment().format('YYYY-MM-DD');
            });
        </script>
    </body>
</html>