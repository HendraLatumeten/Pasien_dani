<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(idtempat)+1, 1) from tempattingga;";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "idtempat" => $kode
    );
    echo json_encode($data);
?>