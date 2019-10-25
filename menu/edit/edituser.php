<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    session_start();
    include '../../config/connection.php';
    $iduser = $_GET['id'];
    $edituser = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "Select * From userlogin where iduser = '$iduser'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $edituser[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><img src="img/images.png" width="50" width="50" alt="Admin SD">  Edit Data User <?php echo $edituser[0][namauser]?></h4>
    </div>
    <div class="modal-body">
        <form id="formedituser" name="formedituser" class="form-horizontal" method="post" role="form" 
            action="data/simpanuser.php?act=edit" novalidate="novalidate">
            <div class="form-group">
                <label for="iduser1" class="col-md-4 control-label input-sm">Id User</label>
                <div class="col-md-2">
                    <input type="text" class="form-control input-sm" id="iduser1" name="iduser"
                        placeholder="Id User" readonly value="<?php echo $edituser[0][iduser]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namauser1" class="col-md-4 control-label input-sm">Nama User</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" id="namauser1" name="namauser"
                        placeholder="Nama User" value="<?php echo $edituser[0][namauser]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="passuser" class="col-md-4 control-label input-sm">Password</label>
                <div class="col-md-5">
                    <input type="password" class="form-control input-sm" id="passuser1" placeholder="Password User"
                        name="passuser" required value="<?php echo $edituser[0][passuser]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="konfirpassword" class="col-md-4 control-label input-sm">Konfirmasi Password</label>
                <div class="col-md-5 m-b-10">
                    <input type="password" class="form-control input-sm" id="konfirpassword1" 
                        placeholder="Konfirmasi Password User" name="konfirpassword" required
                         value="<?php echo $edituser[0][passuser]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namadepan" class="col-md-4 control-label input-sm">Nama Depan</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" id="namadepan1" 
                        placeholder="Nama Depan User" name="namadepan" required
                         value="<?php echo $edituser[0][namadepan]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="namabelakang" class="col-md-4 control-label input-sm">Nama Belakang</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" id="namabelakang1" 
                        placeholder="Nama Belakang User" name="namabelakang" required
                         value="<?php echo $edituser[0][namabelakang]?>">
                </div>
            </div>
            <div class="form-group">
                <label for="idgroup" class="col-md-4 control-label input-sm">Group User</label>
                <div class="col-md-5">
                    <select id="idgroup1" name="idgroup" class="form-control input-sm" required>
<?php
    $linkgroup = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if(!$linkgroup){
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    if($resultgroup = mysqli_query($linkgroup, "Select * From groupuser")){
        $nbrowgroup = mysqli_num_rows($resultgroup);
        if($nbrowgroup>0){
            while($recgroup = mysqli_fetch_array($resultgroup, MYSQL_ASSOC)){
                $idgroup = $recgroup['idgroup'];
                $namagroup = $recgroup['namagroup'];
                if($idgroup === $edituser[0][idgroup]){echo "<option value=$idgroup selected>$namagroup</option>";}
                else{echo "<option value=$idgroup>$namagroup</option>";}
            }
        }
        mysqli_free_result($resultgroup);
    }
    mysqli_close($linkgroup);
?>
                    </select>
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
            window.location = "user";
        });
        var test;
        test = $("#formedituser").validate({
            rules:{
                iduser:{required : true},
                namauser:{required : true}
            },
            messages:{
                iduser:{required: "Id User tidak boleh kosong"},
                namauser:{required: "Nama User tidak boleh kosong"}
            },
            highlight: function(element){
              jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element){
              jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#formedituser').on('submit', function(e){
            e.preventDefault();
            if(jQuery('#iduser1').val() === '' || jQuery('#namauser1').val() === ''){
                return false;
            }
            else{
                jQuery(this).ajaxSubmit({
                    method: 'POST',
                    success: function(data){
                        if(data === 'true'){
                            jQuery.gritter.add({
                                title: 'User',
                                text: 'Simpan User Sukses',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan User Sukses', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                                window.location = "user";
                            });
                        }
                        else if(data === 'false'){
                            jQuery.gritter.add({
                                title: 'User',
                                text: 'Simpan User Gagal',
                                sticky: false,
                                time: ''
                            });
                            $.alerts.dialogClass = 'alert-blue';
                            jAlert('Simpan User Gagal', 'Konfirmasi', function(){
                                $.alerts.dialogClass = null;
                            });
                        }
                        else{
                            jQuery.gritter.add({
                                title: 'User',
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