<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idalasan)+1, 1) from alasan";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idalasan" => $kode
    );
    echo json_encode($data);
?>