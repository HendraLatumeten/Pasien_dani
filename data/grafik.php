<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    ini_set('max_execution_time', 600);
    include "../config/connection.php";
    if(isset($_GET['id'])){$id = $_GET['id'];} else {$id = $_POST['id'];}
    $output1 = array(
        "label" => "Pendaftaran",
        "data" => array(),
        "color" => '#3276B1',
        "bars" => array(
            "show" => true,
            "barWidth" => 0.1,
            "order" => 1
        )
    );
    $output2 = array(
        "label" => "Penerimaan",
        "data" => array(),
        "color" => '#71843F',
        "bars" => array(
            "show" => true,
            "barWidth" => 0.1,
            "order" => 2
        )
    );
    $aColumns = array('Tahun', 'Jumlah');
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    if ($result = mysqli_query($link, "call GetGrafik($id)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $row = array();
                for($i=0; $i<count($aColumns); $i++){
                    if($aColumns[$i] != ' '){
                        $row[] = $rec[$aColumns[$i]];
                    }
                }
                if($id === '1'){$output1['data'][] = $row;}
                else if($id === '2'){$output2['data'][] = $row;}
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
    if($id === '1'){echo json_encode($output1);}
    else if($id === '2'){echo json_encode($output2);}
?>