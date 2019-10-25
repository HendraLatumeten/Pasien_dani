<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idlembaga)+1, 1) from lembaga";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idlembaga" => $kode
    );
    echo json_encode($data);
?>