<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idkhusus)+1, 1) from kebutuhankhusus";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idkhusus" => $kode
    );
    echo json_encode($data);
?>