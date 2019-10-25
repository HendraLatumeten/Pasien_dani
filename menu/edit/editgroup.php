<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idgroup = $_GET['id'];
    $editgroup = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From groupuser Where idgroup = '$idgroup'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $editgroup[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Group <?php echo $editgroup[0][namagroup]?></h4>
    </div>
    <div class="modal-body">
        <form id="formeditgroup" name="formeditgroup" class="form-horizontal" method="post" role="form" 
            action="data/simpangroup.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idgroup1" class="col-md-4 control-label">Id Group</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idgroup1" name="idgroup"
                        placeholder="Id Group" readonly value="<?php echo $editgroup[0][idgroup]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namagroup1" class="col-md-4 control-label">Nama Group</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namagroup1" name="namagroup"
                        placeholder="Nama Group" value="<?php echo $editgroup[0][namagroup]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="keterangangroup1" class="col-md-4 control-label">Keterangan Group</label>
                <div class="col-md-8">
                    <textarea type="text" class="form-control" id="keterangangroup1" name="keterangangroup"
                        placeholder="Keterangan Group" rows="3"><?php echo $editgroup[0][keterangangroup]?></textarea>
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
            window.location = "groupuser";
        });
        var test;
        test = $("#formeditgroup").validate({
            rules:{
                idgroup:{required : true},
                namagroup:{required : true}
            },
            messages:{
                idgroup:{required: "Id Group tidak boleh kosong"},
                namagroup:{required: "Nama Group tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formeditgroup').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idgroup1').val() === '' || jQuery('#namagroup1').val() === ''){
                return false;
            }
            else{
                jQuery(this).ajaxSubmit({
                    method: 'POST',
                    success: function(data){
                        if(data === 'true'){
                            jQuery.gritter.add({
                                title: 'Group User',
                                text: 'Simpan Group User Sukses',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Group Sukses', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                                window.location = "groupuser";
                            });
                        }
                        else if(data === 'false'){
                            jQuery.gritter.add({
                                title: 'Group User',
                                text: 'Simpan Group User Gagal',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Group User Gagal', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                            });
                        }
                        else{
                            jQuery.gritter.add({
                                title: 'Group User',
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