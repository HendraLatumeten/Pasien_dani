<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $idtempat = $_GET['id'];
    $edittempat = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From tempattinggal Where idtempat = '$idtempat'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $edittempat[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data Petempatan <?php echo $edittempat[0][namatempat]?></h4>
    </div>
    <div class="modal-body">
        <form id="formedittempat" name="formedittempat" class="form-horizontal" method="post" role="form" 
            action="data/simpantempattinggal.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="idtempat1" class="col-md-4 control-label">Id Petempatan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idtempat1" name="idtempat"
                        placeholder="Id Petempatan" readonly value="<?php echo $edittempat[0][idtempat]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namatempat1" class="col-md-4 control-label">Nama Petempatan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="namatempat1" name="namatempat"
                        placeholder="Nama Petempatan" value="<?php echo $edittempat[0][namatempat]?>">
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
            window.location = "tempattinggal";
        });
        var test;
        test = $("#formedittempat").validate({
            rules:{
                idtempat:{required : true},
                namatempat:{required : true}
            },
            messages:{
                idtempat:{required: "Id Petempatan tidak boleh kosong"},
                namatempat:{required: "Nama Petempatan tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formedittempat').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#idtempat1').val() === '' || jQuery('#namatempat1').val() === ''){
                return false;
            }
            else{
                jQuery(this).ajaxSubmit({
                    method: 'POST',
                    success: function(data){
                        if(data === 'true'){
                            jQuery.gritter.add({
                                title: 'Petempatan',
                                text: 'Simpan Petempatan Sukses',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Petempatan Sukses', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                                window.location = "tempattinggal";
                            });
                        }
                        else if(data === 'false'){
                            jQuery.gritter.add({
                                title: 'Petempatan',
                                text: 'Simpan Petempatan Gagal',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan Petempatan Gagal', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                            });
                        }
                        else{
                            jQuery.gritter.add({
                                title: 'Petempatan',
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