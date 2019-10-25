<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idalasan = $_GET['id'];
    $editalasan = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From alasan Where idalasan = '$idalasan'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $editalasan[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Alasan <?php echo $editalasan[0][namaalasan]?></h4>
    </div>
    <div class="modal-body">
        <form id="formeditalasan" name="formeditalasan" class="form-horizontal" method="post" role="form" 
            action="data/simpanalasan.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idalasan1" class="col-md-4 control-label">Id Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idalasan1" name="idalasan"
                        placeholder="Id Alasan" readonly value="<?php echo $editalasan[0][idalasan]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namaalasan1" class="col-md-4 control-label">Nama Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namaalasan1" name="namaalasan"
                        placeholder="Nama Alasan" value="<?php echo $editalasan[0][namaalasan]?>">
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
            window.location = "alasan";
        });
        var test;
        test = $("#formeditalasan").validate({
            rules:{
                idalasan:{required : true},
                namaalasan:{required : true}
            },
            messages:{
                idalasan:{required: "Id Alasan tidak boleh kosong"},
                namaalasan:{required: "Nama Alasan tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formeditalasan').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idalasan1').val() === '' || jQuery('#namaalasan1').val() === ''){
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
                                window.location = "alasan";
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