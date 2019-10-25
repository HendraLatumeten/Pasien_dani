<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idcita)+1, 1) from cita";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idcita" => $kode
    );
    echo json_encode($data);
?>