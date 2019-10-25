<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idhasil)+1, 1) from penghasilan";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idhasil" => $kode
    );
    echo json_encode($data);
?>