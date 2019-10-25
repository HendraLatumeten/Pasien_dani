<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idgroup)+1, 1) from groupuser";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idgroup" => $kode
    );
    echo json_encode($data);
?>