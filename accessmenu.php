<?php
    session_start();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }

    if ($result = mysqli_query($link, "call GetMenuAccess('$_SESSION[GroupId]')")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                if($rec[MenuHRef] == "#"){
                    echo "<li ".$rec['Class'].">";
                    echo "<a href='".$rec[MenuHRef]."'>";
                    echo "<i class='".$rec[MenuClass]."'></i> <span>".$rec[MenuCaption]."</span>";
                    echo "<i class='fa fa-angle-left pull-right'></i>";
                    echo "</a>";
                    echo "<ul class='treeview-menu'>";
                    $link1 = mysqli_connect($host, $dbuser, $dbpassword, $database);
                    if (!$link1) {
                        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
                        exit;
                    }
                    if ($result1 = mysqli_query($link1, "call GetMenuAccessChild('$_SESSION[GroupId]', '$rec[MenuId]')")){
                        $nbrows1 = mysqli_num_rows($result1);
                        if($nbrows1>0){
                            while($rec1 = mysqli_fetch_array($result1, MYSQL_ASSOC)){
                                if($rec1[MenuHRef] == $getactive){
                                    echo "<li><a class='active' href='$rec1[MenuHref]'><i class='$rec1[MenuClass]'></i> ".$rec1[MenuCaption]."</a></li>";
                                }
                                else{
                                    //echo "<li><a href='$rec1[MenuHref]'>".$rec1[MenuCaption]."</a></li>";
                                    echo "<li><a href='$rec1[MenuHref]'><i class='$rec1[MenuClass]'></i> ".$rec1[MenuCaption]."</a></li>";
                                }
                            }
                        }
                        mysqli_free_result($result1);
                    }
                    mysqli_close($link1);
                    echo "</ul>";
                    echo "</li>";
                }
                else{
                    if($getactive == 'home' && $rec[MenuHRef] == $getactive){
                        echo "<li class='active'>";
                        echo "<a href='$rec[MenuHRef]'>";
                        echo "<i class='".$rec[MenuClass]."'></i> <span>".$rec[MenuCaption]."</span>";
                        echo "</a>";
                        echo "</li>";
                    }
                    else{
                        echo "<li class=''>";
                        echo "<a href='$rec[MenuHRef]'>";
                        echo "<i class='".$rec[MenuClass]."'></i> <span>".$rec[MenuCaption]."</span>";
                        echo "</a>";
                        echo "</li>";
                    }
                }
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>