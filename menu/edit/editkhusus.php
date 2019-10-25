<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idkhusus = $_GET['id'];
    $editkhusus = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From kebutuhankhusus Where idkhusus = '$idkhusus'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $editkhusus[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Alasan <?php echo $editkhusus[0][namakhusus]?></h4>
    </div>
    <div class="modal-body">
        <form id="formeditkhusus" name="formeditkhusus" class="form-horizontal" method="post" role="form" 
            action="data/simpankhusus.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idkhusus1" class="col-md-4 control-label">Id Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idkhusus1" name="idkhusus"
                        placeholder="Id Alasan" readonly value="<?php echo $editkhusus[0][idkhusus]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namakhusus1" class="col-md-4 control-label">Nama Alasan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namakhusus1" name="namakhusus"
                        placeholder="Nama Alasan" value="<?php echo $editkhusus[0][namakhusus]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="poinkhusus1" class="col-md-4 control-label">Point Khusus</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="poinkhusus1" name="poinkhusus"
                        placeholder="Point Khusus" value="<?php echo $editkhusus[0][poinkhusus]?>">
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
            window.location = "khusus";
        });
        var test;
        test = $("#formeditkhusus").validate({
            rules:{
                idkhusus:{required : true},
                namakhusus:{required : true}
            },
            messages:{
                idkhusus:{required: "Id Alasan tidak boleh kosong"},
                namakhusus:{required: "Nama Alasan tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formeditkhusus').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idkhusus1').val() === '' || jQuery('#namakhusus1').val() === ''){
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
                                window.location = "khusus";
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