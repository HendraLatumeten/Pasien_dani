<?php
    include "../config/connection.php";
    session_start();
    $sql = "Select IfNull(Max(iddaftar)+1, 1), Concat('PD', LPad(IfNull(Max(iddaftar)+1, 1), 3, 0)) "
       . "from pendaftaran";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_row($result)) {
        $kode = $row[0];
        $kode1 = $row[1];
    }
    $data[] = array(
        "iddaftar" => $kode,
        "kodedaftar" => $kode1
    );
    echo json_encode($data);
?>