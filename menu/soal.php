<?php
    include("../config/connection.php");
    error_reporting(0);
    $iddaftar = $_SESSION['IdDaftar'];
    if(isset($_GET['iddaftar'])){
        $id_pertanyaan = addslashes(strip_tags($_GET['idpertanyaan']));
        $RbJawaban = addslashes (strip_tags($_GET['RbJawaban']));
        $val = "select * from pertanyaan where idpertanyaan = '$id_pertanyaan'";
        $angka=mysql_query($val);
        $row=mysql_fetch_array($angka);
        if($row['opt_true'] == "$RbJawaban"){$nom = $row['opt_value'];}
        else{$nom = 0;}
        $query = "INSERT INTO hasiltest VALUES('$id_pertanyaan','$iddaftar','$RbJawaban')";
        $sql = mysql_query ($query);
    }
$sqlh1 = "Select count(*) total From pertanyaan";
$rsh1=mysql_query($sqlh1);
$datah1=mysql_fetch_array($rsh1);
$sqlp1 = "Select count(*) total From hasiltest Where iddaftar = '$iddaftar'";
$rs1=mysql_query($sqlp1);			
$data1=mysql_fetch_array($rs1);
if($data1['total'] != $datah1['total']){
?>
<div class="row">
    <div class="col-md-12">
		<?php 
			$sqlh = "Select count(*) total From pertanyaan";
			$rsh=mysql_query($sqlh);
			$datah=mysql_fetch_array($rsh);
			$sqlp = "Select count(*) total From hasiltest Where iddaftar = '$iddaftar'";
			$rs=mysql_query($sqlp);			
			$data=mysql_fetch_array($rs);
            //$total = 0;
			if($data['total'] != $datah['total']){
                $total = $data['total']+1;
                $totalsoal = $data['total'];
                $sqlp = "Select * From pertanyaan Where idpertanyaan Not In "
                . "(Select idpertanyaan From hasiltest Where iddaftar = '$iddaftar') order by rand()";
                $rs=mysql_query($sqlp);	
                $no = 0;		
                $no++;
                $data=mysql_fetch_array($rs);
				echo "<form name='soal' onsubmit='return validate()'>";
				echo "<input type='hidden' name='iddaftar' value='$iddaftar'>
				<input type='hidden' name='idpertanyaan' value='$data[idpertanyaan]'><br>";
				echo "$total.&nbsp;&nbsp;$data[isipertanyaan]<br>";
                echo "<br>";
                echo "<div class='row'>";
                echo "<div id='test' class='form-group'>";
                if($data[valuepertanyaan] === 'huruf'){
                    for($alpha=65; $alpha<=90; $alpha++){
                        if($alpha === 77 || $alpha === 89){
                            echo "<div class='col-md-12'>";
                            echo "<label for='' class='col-md-12 control-label'></label>";
                            echo "<label for='' class='col-md-12 control-label'></label>";
                            echo "<label for='' class='col-md-12 control-label'></label>";
                            echo "<label for='' class='col-md-12 control-label'></label>";
                            echo "</div>";
                            echo "<div class='col-md-1'>";
                            echo "<input type='button' id='btn' name='".chr($alpha)."' class='control-label btn btn-default btn-lg' value=".chr($alpha).">";
                            echo "</div>";
                        }
                        else{
                            echo "<div class='col-md-1'>";
                            echo "<input type='button' id='btn' name='".chr($alpha)."' class='control-label btn btn-default btn-lg' value=".chr($alpha).">";
                            echo "</div>";
                        }
                    }
                }
                else{
                    for($i=0; $i<10; $i++){
                        echo "<div class='col-md-1'>";
                        echo "<input type='button' id='angka".$i."' name='angka".$i."' class='control-label btn btn-default btn-lg' value='$i'>";
                        echo "</div>";
                    }
                }
                echo "</div>";
                echo "<div class='col-md-12'>";
                echo "<label for='' class='col-md-12 control-label'></label>";
                echo "<label for='' class='col-md-12 control-label'></label>";
                echo "<label for='' class='col-md-12 control-label'></label>";
                echo "<label for='' class='col-md-12 control-label'></label>";
                echo "</div>";
                echo "</div>";
				//echo "<div class='radio'><label>A.<input type='radio' value='$data[opt_1]' name='RbJawaban'>"; echo "$data[opt_1] </label></div>";
                echo "<input type='text' class='form-control input-lg' name='RbJawaban' id='RbJawaban'>";
                echo "<div class='col-md-12'>";
                echo "<label for='' class='col-md-12 control-label'></label>";
                echo "</div>";
				echo "<input type='submit' class='btn btn-primary btn-block btn-lg' name='lanjut' value='Lanjut'>";
			}
            echo "</form>";		
		//}
		?>
    </div>
</div>
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script type='text/javascript'>
$(window).load(function(){
    var $ = function (selector) {
        return document.querySelector(selector);
    };
    
    var test = $('#test').getElementsByTagName('input');
    for (var i = 0; i < test.length; i++) {
        var link = test[i];

        // <li> onclick, runAlert function
        link.onclick = dynamicEvent;
    }
    
    function dynamicEvent(){
        var text = $('#RbJawaban').value;
        //alert(this.value);
        text = text + this.value;
        $('#RbJawaban').value = text;
    }
/*    
    $("div.btn-input").on('click', function(){
        var btn = $(this),
            container = btn.parent(),
            name = btn.data('toggle-name'),
            hidden = container.find('input[name="' + name + '"]'),
            value = btn.attr('value');

        hidden.val(value);
        container.find(".btn-input").removeClass('active btn-primary');
        btn.addClass('active btn-primary');
    });
*/
});
</script>
<?php
}
else{
?>
<div class="row">
    <div class="col-md-12">
    </div>
</div>
<script src="../js/jquery.min.js" type="text/javascript"></script>
<?php
}
?>
