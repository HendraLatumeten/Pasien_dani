<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    include "../config/connection.php";
    ini_set('max_execution_time', 600);
    session_start();
    function checkiddaftar($iddaftar){
        $sql = "Select IfNull(idstatus, 0) idstatus from pendaftaran where iddaftar = '$iddaftar'";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_row($result)){
            $kode = $row[0];
        }
        return $kode;
    }
    if(isset($_GET['kode'])){$kode = $_GET['kode'];} else {$kode = $_POST['kode'];}
    if(isset($_GET['iddaftar'])){$iddaftar = $_GET['iddaftar'];} else {$iddaftar = $_POST['iddaftar'];}
    if($kode === "1"){
        $cekiddaftar = checkiddaftar($iddaftar);
        if($cekiddaftar === '0'){echo "false";}
        else if($cekiddaftar === '1'){echo "false1";}
        else if($cekiddaftar === '2'){echo "true";}
        else if($cekiddaftar === '3'){echo "false2";}
        else{echo "false3";}
    }
    else{
        $sql = "Select * From pendaftaran Limit 0, 0";
        $resultcoloumn = mysql_query($sql);

        $numberfields1 = mysql_num_fields($resultcoloumn);
        // Input Field To Variable PHP
        $var1 = array();
        for ($i=0; $i<$numberfields1; $i++ ) {
           $var1[] = mysql_field_name($resultcoloumn, $i);
        }
        mysql_free_result($resultcoloumn);
        
        /* Showing Data With Variable Field PHP */
        $sQuery1 = "
            Select SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $var1))."
            From (";
        $sQuery1 .= "Select * From pendaftaran Where iddaftar = '$iddaftar'";
        $sQuery1 .= ") a";
        $result = mysql_query($sQuery1);
        
        $iTotal = mysql_num_rows($result);

        $numberfields = mysql_num_fields($result);

        $var = array();
        for ($i=0; $i<$numberfields ; $i++ ) {
           $var[] = mysql_field_name($result, $i);
        }


        $output = array(
            "aaData" => array()
        );

        while($row = mysql_fetch_array($result)){
            $row1 = array();
            for ( $i=0 ; $i<count($var) ; $i++ )
            {
                /* General output */
                $row1[$var[$i]] = $row[$var[$i]];
            }
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
?>