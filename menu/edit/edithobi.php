<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idhobi = $_GET['id'];
    $edithobi = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From hobi Where idhobi = '$idhobi'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $edithobi[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Hobi <?php echo $edithobi[0][namahobi]?></h4>
    </div>
    <div class="modal-body">
        <form id="formedithobi" name="formedithobi" class="form-horizontal" method="post" role="form" 
            action="data/simpanhobi.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idhobi1" class="col-md-4 control-label">Id Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idhobi1" name="idhobi"
                        placeholder="Id Alasan" readonly value="<?php echo $edithobi[0][idhobi]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namahobi1" class="col-md-4 control-label">Nama Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namahobi1" name="namahobi"
                        placeholder="Nama Alasan" value="<?php echo $edithobi[0][namahobi]?>">
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
            window.location = "hobi";
        });
        var test;
        test = $("#formedithobi").validate({
            rules:{
                idhobi:{required : true},
                namahobi:{required : true}
            },
            messages:{
                idhobi:{required: "Id Alasan tidak boleh kosong"},
                namahobi:{required: "Nama Alasan tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formedithobi').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idhobi1').val() === '' || jQuery('#namahobi1').val() === ''){
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
                                window.location = "hobi";
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