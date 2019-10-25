<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(iduser)+1, 1) from userlogin";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
    }
    $data[] = array(
        "iduser" => $kode
    );
    echo json_encode($data);
?>