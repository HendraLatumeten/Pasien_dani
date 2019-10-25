<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    ini_set('max_execution_time', 600);
    include "../config/connection.php";
    $id = $_GET['idgroup'];
    $test = "";
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
        exit;
    }
    //, MYSQL_ASSOC
    if ($result = mysqli_query($link, "call GetMenuAccessGroup($id)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQL_ASSOC)){
                $noid = $rec['NoId'];
                $href = $rec['MenuHref'];
                $href1 = $rec['MenuHref1'];
                $caption = $rec['MenuCaption'];
                $description = $rec['MenuDescription'];
                $checked = $rec['active'];
                if($href === '#' && $noid === '5'){
                    $test .= "<div class='clearfix'></div>";
                }
                $test .= "<div class='col-sm-3'>";
                if($href === '#'){
                    $test .= "<div class='ckbox ckbox-primary'>";
                    $test .= "<input class='minimal' type='checkbox' value='$noid' id='$href1' name='menuaccess[]' $checked>";
                    $test .= "<label for='$href1'>$caption</label>";
                    $test .= "</div>";
                    $linkchild = mysqli_connect($host, $dbuser, $dbpassword, $database);
                    if (!$linkchild) {
                        printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
                        exit;
                    }
                    if ($resultchild = mysqli_query($linkchild, "call GetMenuAccessGroupChild($noid, $id)")){
                        $nbrowsc = mysqli_num_rows($resultchild);
                        if($nbrowsc>0){
                            while($recchild = mysqli_fetch_array($resultchild, MYSQL_ASSOC)){
                                $hrefchild = $recchild['MenuHref'];
                                $noidchild = $recchild['NoIdChild'];
                                $captionchild = $recchild['MenuCaption'];
                                $descriptionchild = $recchild['MenuDescription'];
                                $checkedchild = $recchild['active'];
                                $test .= "<div class='col-sm-12'>";
                                $test .= "<div class='ckbox ckbox-primary'>";
                                $test .= "<input type='checkbox' value='$noidchild' id='$hrefchild' name='menuaccess1[]' $checkedchild>";
                                $test .= "<label for='$hrefchild'>$captionchild</label>";
                                $test .= "</div>";
                                $test .= "</div>";
                            }
                        }
                        mysqli_free_result($resultchild);
                    }
                    mysqli_close($linkchild);
                }
                else{
/*
                    $test .= "<div class='ckbox ckbox-primary'>";
                    $test .= "<input class='minimal' type='checkbox' value='$noid' id='$href' name='menuaccess[]' $checked>";
                    $test .= "<label for='$href'>$caption</label>";
                    $test .= "</div>";
 */
                    $test .= "<label for='$href'>";
                    $test .= "<input class='minimal' type='checkbox' value='$noid' id='$href' name='menuaccess[]' $checked>$caption</label>";
                    $test .= "</div>";
                }
                $test .= "</div>";
/*
                $test .= "<div class='col-md-3'>";
                $test .= "<div class='ckbox ckbox-primary'>";
                $test .= "<input type='checkbox' value='$href' id='$href' name='menuaccess[]' $checked>";
                $test .= "<label for='$href'>$caption</label>";
                $test .= "</div>";
                $test .= "</div>";
*/
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
    echo $test;
?>
