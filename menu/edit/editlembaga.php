<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idlembaga = $_GET['id'];
    $editlembaga = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From lembaga Where idlembaga = '$idlembaga'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $editlembaga[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Lembaga <?php echo $editlembaga[0][namalembaga]?></h4>
    </div>
    <div class="modal-body">
        <form id="formeditlembaga" name="formeditlembaga" class="form-horizontal" method="post" role="form" 
            action="data/simpanlembaga.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idlembaga1" class="col-md-4 control-label">Id Lembaga</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idlembaga1" name="idlembaga"
                        placeholder="Id Lembaga" readonly value="<?php echo $editlembaga[0][idlembaga]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namalembaga1" class="col-md-4 control-label">Nama Lembaga</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namalembaga1" name="namalembaga"
                        placeholder="Nama Lembaga" value="<?php echo $editlembaga[0][namalembaga]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="keteranganlembaga1" class="col-md-4 control-label">Keterangan Lembaga</label>
                <div class="col-md-8">
                    <textarea type="text" class="form-control" id="keteranganlembaga1" name="keteranganlembaga"
                        placeholder="Keterangan Lembaga" rows="3"><?php echo $editlembaga[0][keteranganlembaga]?></textarea>
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
            window.location = "lembaga";
        });
        var test;
        test = $("#formeditlembaga").validate({
            rules:{
                idlembaga:{required : true},
                namalembaga:{required : true}
            },
            messages:{
                idlembaga:{required: "Id Lembaga tidak boleh kosong"},
                namalembaga:{required: "Nama Lembaga tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formeditlembaga').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idlembaga1').val() === '' || jQuery('#namalembaga1').val() === ''){
                return false;
            }
            else{
                jQuery(this).ajaxSubmit({
                    method: 'POST',
                    success: function(data){
                        if(data === 'true'){
                            jQuery.gritter.add({
                                title: 'Lembaga',
                                text: 'Simpan Lembaga Sukses',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Lembaga Sukses', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                                window.location = "lembaga";
                            });
                        }
                        else if(data === 'false'){
                            jQuery.gritter.add({
                                title: 'Lembaga',
                                text: 'Simpan Lembaga Gagal',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Lembaga Gagal', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                            });
                        }
                        else{
                            jQuery.gritter.add({
                                title: 'Lembaga',
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