<?php
    function getMax($ColId, $tbName){
        $query = "Select IfNull(Max($ColId)+1, 1) as id ";
        $query .= "from $tbName ";
        $result = mysql_query($query);
        if (mysql_num_rows($result) > 0){
            while($row = mysql_fetch_array($result)){
                $id = $row[0];
            }
        }
        else{
            $id = 1;
        }
        if($id === NULL ){
                $id = 1;
        }
        return $id;
    }
    function getcode($colid, $tbname, $length){
        $query = "Select Concat('S', LPad(IfNull(Max($colid)+1, 1), $length, 0)) as id ";
        $query .= "from $tbname ";
        $result = mysql_query($query);
        if (mysql_num_rows($result) > 0){
            while($row = mysql_fetch_array($result)){
                $id = $row[0];
            }
        }
        else{
            $id = 'S0001';
        }
        if($id === NULL ){
                $id = 'S0001';
        }
        return $id;
    }
    function add_date($orgDate, $mth){
        $cd = strtotime($orgDate);
        $retDAY = date('Y-m-d', mktime(0, 0, 0, date('m', $cd) + $mth, date('d', $cd), date('Y', $cd)));
        return $retDAY;
    }
    function dateadd($date, $limit){
        $query = "Select DATE_ADD('$date', INTERVAL $limit DAY);";
        $result = mysql_query($query);
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_array($result)){
                $tanggal = $row[0];
            }
        }
        return $tanggal;
    }
?>