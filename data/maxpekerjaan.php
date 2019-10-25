<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idkerja)+1, 1) from pekerjaan";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idkerja" => $kode
    );
    echo json_encode($data);
?>