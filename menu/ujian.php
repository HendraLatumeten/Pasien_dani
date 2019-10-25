<?php
    error_reporting(0);
    include "../config/connection.php";
    session_start();
    $namauser = $_SESSION['NamaUser'];
    $groupuser = $_SESSION['NamaGroup'];
    $photo = $_SESSION['Photo'];
    $groupid = $_SESSION['GroupId'];
    $iddaftar = $_SESSION['IdDaftar'];
?>
                <div class="row">
<?php
    $sqlp = "Select count(*) total From pertanyaan";
    $rs = mysql_query($sqlp);
    $data = mysql_fetch_array($rs);
    
    $sqlh = "Select count(*) total From hasiltest Where iddaftar ='$iddaftar';";
    $rsh = mysql_query($sqlh);
    $datah = mysql_fetch_array($rsh);
    if($datah['total'] != $data['total']){
?>
                        <div class="col-md-12">
                            <div class="tile">
                                <h2 class="tile-title">Test Ujian Siswa</h2>
                                <div class="p-10">
        <script src="../js/jquery.min.js"></script>
        <script type="text/javascript">
            function countDown(secs, elem){
                var element = document.getElementById(elem);
                element.innerHTML = "Waktu Anda Mengerjakan soal adalah <b>"+secs+"</b> detik";
                if(secs < 1){
                    document.soal.submit();
                }
                else{
                    secs--;
                    setTimeout('countDown('+secs+',"'+elem+'")',1500);
                }
            }
            function validate(){return true;}
            jQuery(document).ready(function(){
                countDown(10,"status");
            });
        </script>
                                    <div id="status"></div>
                                    <?php include('soal.php');?>
                                </div>
                            </div>
                        </div>
<?php
    }
    else{
?>
                        <div class="col-md-12">
                            <div class="tile">
                                <h2 class="tile-title">Test Ujian Siswa</h2>
                                <div class="p-10">
                                    <h2 class="tile-title"><center>Selamat Anda Telah Selesai Mengerjakan Soal Ujian Test</center></h2>
                                    <div class="m-t-20">
                                        <center><a href="../home"><button class="btn btn-lg" type="button" id="mulai" name="mulai">Halaman Utama</button></a></center>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
    }
?>
                    </div>
