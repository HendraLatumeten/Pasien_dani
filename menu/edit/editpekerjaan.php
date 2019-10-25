<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idkerja = $_GET['id'];
    $editkerja = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From pekerjaan Where idkerja = '$idkerja'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $editkerja[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Pekerjaan <?php echo $editkerja[0][namakerja]?></h4>
    </div>
    <div class="modal-body">
        <form id="formeditkerja" name="formeditkerja" class="form-horizontal" method="post" role="form" 
            action="data/simpanpekerjaan.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idkerja1" class="col-md-4 control-label">Id Pekerjaan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idkerja1" name="idkerja"
                        placeholder="Id Pekerjaan" readonly value="<?php echo $editkerja[0][idkerja]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namakerja1" class="col-md-4 control-label">Nama Pekerjaan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namakerja1" name="namakerja"
                        placeholder="Nama Pekerjaan" value="<?php echo $editkerja[0][namakerja]?>">
                </div>
            </div>
            <button id="simpan" name="simpan" type="submit" class="btn btn-primary">Simpan</button>
            <button id="tutup" name="tutup" type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </form>
    </div>
</div>
<script src="js/plugins/jquery-gritter/jquery.gritter.js" type="text/javascript"></script>
<script src="js/plugins/jquery-alert/jquery.alerts.js" type="text/javascript"></script>
<script src="js/plugins/jquery-form/jquery-form.min.js" type="text/javascript"></script>
<script src="js/plugins/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#tutup').on('click', function(){
            window.location = "pekerjaan";
        });
        var test;
        test = $("#formeditkerja").validate({
            rules:{
                idkerja:{required : true},
                namakerja:{required : true}
            },
            messages:{
                idkerja:{required: "Id Pekerjaan tidak boleh kosong"},
                namakerja:{required: "Nama Pekerjaan tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formeditkerja').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idkerja1').val() === '' || jQuery('#namakerja1').val() === ''){
                return false;
            }
            else{
                jQuery(this).ajaxSubmit({
                    method: 'POST',
                    success: function(data){
                        if(data === 'true'){
                            jQuery.gritter.add({
                                title: 'Pekerjaan',
                                text: 'Simpan Pekerjaan Sukses',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Pekerjaan Sukses', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                                window.location = "pekerjaan";
                            });
                        }
                        else if(data === 'false'){
                            jQuery.gritter.add({
                                title: 'Pekerjaan',
                                text: 'Simpan Pekerjaan Gagal',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Pekerjaan Gagal', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                            });
                        }
                        else{
                            jQuery.gritter.add({
                                title: 'Pekerjaan',
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
            }
        });
    });
</script>