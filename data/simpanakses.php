<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    ini_set('max_execution_time', 600);
    include "../config/connection.php";
    $menu = $_POST['menuaccess'];
    $menuc = $_POST['menuaccess1'];
    $group = $_POST['idgroup'];
    $sqldel1 = "Delete From menuakses Where GroupId = '$group'";
    $resultdel1 = mysql_query($sqldel1);
    $sqldel2 = "Delete From menuakseschild Where GroupId = '$group'";
    $resultdel2 = mysql_query($sqldel2);
    for($i=0; $i<count($menu); $i++){
        $list = "Select * From menusd Where NoId = '$menu[$i]'";
        $resultlist = mysql_query($list);
        if(mysql_num_rows($resultlist) > 0){
            while($row = mysql_fetch_array($resultlist)){
                $tets = $row[1];
                $sql = "Insert Into menuakses(GroupId, MenuId, class, MenuName, MenuClass, MenuHref, MenuCaption, MenuDescription) ";
                $sql .= "Select '$group', m.* From menusd m Where NoId = '$menu[$i]'";
                //$sql .= "Values('$group', '$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]')";
                $result = mysql_query($sql);
            }
        }
    }
    for($i=0; $i<count($menuc); $i++){
        $list = "Select * From menusdchild Where NoIdChild = '$menuc[$i]'";
        $resultlist = mysql_query($list);
        if(mysql_num_rows($resultlist) > 0){
            while($row = mysql_fetch_array($resultlist)){
                $sql = "Insert Into menuakseschild(GroupId, NoIdChild, NoId, MenuClass, MenuName, MenuHref, MenuCaption, MenuDescription) ";
                $sql .= "Select '$group', m.* From menusdchild m Where NoIdChild = '$menuc[$i]'";
                $result = mysql_query($sql);
            }
        }
    }
    if($result){echo "true";}else{echo "false";}
?>