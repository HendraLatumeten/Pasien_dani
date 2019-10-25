<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idhasil = $_GET['id'];
    $edithasil = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From penghasilan Where idhasil = '$idhasil'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $edithasil[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Penghasilan <?php echo $edithasil[0][namahasil]?></h4>
    </div>
    <div class="modal-body">
        <form id="formedithasil" name="formedithasil" class="form-horizontal" method="post" role="form" 
            action="data/simpanpenghasilan.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idhasil1" class="col-md-4 control-label">Id Penghasilan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idhasil1" name="idhasil"
                        placeholder="Id Penghasilan" readonly value="<?php echo $edithasil[0][idhasil]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namahasil1" class="col-md-4 control-label">Nama Penghasilan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namahasil1" name="namahasil"
                        placeholder="Nama Penghasilan" value="<?php echo $edithasil[0][namahasil]?>">
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
            window.location = "penghasilan";
        });
        var test;
        test = $("#formedithasil").validate({
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
        jQuery('#formedithasil').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idhasil1').val() === '' || jQuery('#namahasil1').val() === ''){
                return false;
            }
            else{
                jQuery(this).ajaxSubmit({
                    method: 'POST',
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
                                window.location = "penghasilan";
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
                            });
                        }
                    }
                });
            }
        });
    });
</script>