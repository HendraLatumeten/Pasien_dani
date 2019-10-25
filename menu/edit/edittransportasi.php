<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idtransportasi = $_GET['id'];
    $edittransportasi = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From transportasi Where idtransportasi = '$idtransportasi'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $edittransportasi[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Alasan <?php echo $edittransportasi[0][namatransportasi]?></h4>
    </div>
    <div class="modal-body">
        <form id="formedittransportasi" name="formedittransportasi" class="form-horizontal" method="post" role="form" 
            action="data/simpantransportasi.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idtransportasi1" class="col-md-4 control-label">Id Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idtransportasi1" name="idtransportasi"
                        placeholder="Id Alasan" readonly value="<?php echo $edittransportasi[0][idtransportasi]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namatransportasi1" class="col-md-4 control-label">Nama Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namatransportasi1" name="namatransportasi"
                        placeholder="Nama Alasan" value="<?php echo $edittransportasi[0][namatransportasi]?>">
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
            window.location = "transportasi";
        });
        var test;
        test = $("#formedittransportasi").validate({
            rules:{
                idtransportasi:{required : true},
                namatransportasi:{required : true}
            },
            messages:{
                idtransportasi:{required: "Id Alasan tidak boleh kosong"},
                namatransportasi:{required: "Nama Alasan tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formedittransportasi').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idtransportasi1').val() === '' || jQuery('#namatransportasi1').val() === ''){
                return false;
            }
            else{
                jQuery(this).ajaxSubmit({
                    method: 'POST',
                    success: function(data){
                        if(data === 'true'){
                            jQuery.gritter.add({
                                title: 'Alasan',
                                text: 'Simpan Alasan Sukses',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Alasan Sukses', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                                window.location = "transportasi";
                            });
                        }
                        else if(data === 'false'){
                            jQuery.gritter.add({
                                title: 'Alasan',
                                text: 'Simpan Alasan Gagal',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Alasan Gagal', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                            });
                        }
                        else{
                            jQuery.gritter.add({
                                title: 'Alasan',
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