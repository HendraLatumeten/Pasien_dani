<?php
    error_reporting(0);
    include "../config/connection.php";
    session_start();
    $namauser = $_SESSION['NamaUser'];
    $groupuser = $_SESSION['NamaGroup'];
    $photo = $_SESSION['Photo'];
    $groupid = $_SESSION['GroupId'];
    function getno(){
        $sql = "Select IfNull(Max(idhasil)+1, 1) from penghasilan";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_row($result)) {
            $kode = $row[0];
        }
        return $kode;
    }
    $no = getno();
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
                        Penghasilan
                        <small>Admin SD</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Master</a></li>
                        <li class="active">Penghasilan</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Entri Data Penghasilan</h3>
                                </div>
                                <div class="box-body">
                                    <form id="hasilform" name="hasilform" role="form" class="form-horizontal"
                                        method="post" action="data/simpanpenghasilan.php?act=new" novalidate="novalidate">
                                        <div class="form-group">
                                            <label for="idhasil" class="col-md-4 control-label">Id Penghasilan</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="idhasil" name="idhasil"
                                                    placeholder="Id Penghasilan" readonly value="<?php echo $no?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="namahasil" class="col-md-4 control-label">Nama Penghasilan</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="namahasil" name="namahasil"
                                                    placeholder="Nama Penghasilan">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Data Penghasilan</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="datahasil" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center" style="width: 10%">No</th>
                                                <th class="center" style="width: 15%">Id Penghasilan</th>
                                                <th style="width: 65%">Nama Penghasilan</th>
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
            
            function getdelete(idhasil){
                $.alerts.dialogClass = 'alert-blue';
                $.alerts.okButton = 'Yes';
                $.alerts.cancelButton = 'No';
                jConfirm('Anda yakin menghapusnya ?', 'Konfirmasi', function(r){
                    if(r === true){
                        window.location = 'data/simpanpenghasilan.php?act=delete&id='+idhasil;
                    }
                    else{return false;}
                });
            }
            jQuery(document).ready(function(){
                function No(){
                    var idhasil = document.getElementById('idhasil');
                    $.ajax({
                        dataType: 'json',
                        url: "data/maxpenghasilan.php",
                        type: "GET",
                        success: function(data){
                            $.each(data, function(i, n){
                                var hasil1 = n["idhasil"];
                                idhasil.value = hasil1;
                            });
                        },
                        failure: function(){

                        }
                    });
                }
                    
                var test;
                test = $("#hasilform").validate({
                    rules:{
                        idhasil:{required : true},
                        namahasil:{required : true}
                    },
                    messages:{
                        idhasil:{required: "Id Penghasilan tidak boleh kosong"},
                        namahasil:{required: "Nama Penghasilan tidak boleh kosong"}
                    },
                    highlight: function(element){
                      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    },
                    success: function(element){
                      jQuery(element).closest('.form-group').removeClass('has-error');
                    }
                });
                
                var datahasil;
                datahasil = $("#datahasil").dataTable({
                    "sDom": "<'row'<'box-body'<'top'T<'col-xs-6'l><'col-xs-12'f>>"+
                            "<'col-sm-12 col-lg-12 no-padding'rt><'bottom'<'col-sm-12'ip>>"+
                            "<'clear'>",
                    "bPaginate": true,
                    "iDisplayLength": 10,
                    "bProcessing": false,
                    "bServerSide": true,
                    "sAjaxSource": "data/datapenghasilan.php",
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
                        {"bSortable": false, "sClass": "center", "mData": "idhasil"},
                        {"bSortable": false, "mData": "namahasil"},
                        {"bSortable": false, "sClass": "center", "fnRender": function(oObj){
                                return "<td>"+
                                       "<a href='editpenghasilan-"+oObj.aData["Action"]+"' "+
                                        "data-toggle='modal' data-target='#remoteModal' data-backdrop='static' class=''>"+
                                        "<span class='glyphicon glyphicon-edit'></span></a>&nbsp"+
                                        '<a href='+"#"+' class="confirm" onclick="getdelete(\''+oObj.aData["Action"]+ '\')">'+
                                        "<span class='glyphicon glyphicon-trash'></span></a>"+
                                       "</td>";
                             }
                        }
                    ],
                    "fnDrawCallback": function( oSettings ){
                        jQuery('div#datahasil_length select, div#datahasil_filter input').addClass("form-control input-group");
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
                jQuery('#hasilform').on('submit', function(e){
                    e.preventDefault();
                    if(jQuery('#idhasil').val() === '' || jQuery('#namahasil').val() === '' ){
                        return false;
                    }
                    else{
                        jQuery(this).ajaxSubmit({
                            success: function(data){
                                if(data === 'true'){
                                    jQuery.gritter.add({
                                        title: 'Penghasilan',
                                        text: 'Simpan Penghasilan Sukses',
                                        sticky: false,
                                        time: ''
                                    });
                                    $.alerts.dialogClass = 'alert-blue';
                                    jAlert('Simpan Penghasilan Sukses', 'Konfirmasi', function(){
                                        $.alerts.dialogClass = null;
                                        jQuery('#hasilform').resetForm();
                                        reloadTabel(datahasil);
                                        No();
                                    });
                                }
                                else if(data === 'false'){
                                    jQuery.gritter.add({
                                        title: 'Penghasilan',
                                        text: 'Simpan Penghasilan Gagal',
                                        sticky: false,
                                        time: ''
                                    });
                                    $.alerts.dialogClass = 'alert-blue';
                                    jAlert('Simpan Penghasilan Gagal', 'Konfirmasi', function(){
                                        $.alerts.dialogClass = null;
                                        No();
                                    });
                                }
                                else{
                                    jQuery.gritter.add({
                                        title: 'Penghasilan',
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
            });
        </script>
    </body>
                <div class='modal fade' id='remoteModal' tabindex='-1' role='dialog' 
                    aria-labelledby='remoteModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class="modal-header">
                                
                            </div>
                        </div>
                    </div>
                </div>
</html>