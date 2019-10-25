<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    include "../config/connection.php";
    ini_set('max_execution_time', 600);
    session_start();
    $sql = "Select Null `No`, a.*, null namagroup, iduser Action From userlogin a Limit 0, 0";
    $resultcoloumn = mysql_query($sql);
    
    $numberfields1 = mysql_num_fields($resultcoloumn);
    // Input Field To Variable PHP
    $var1 = array();
    for ($i=0; $i<$numberfields1; $i++ ) {
       $var1[] = mysql_field_name($resultcoloumn, $i);
    }
    mysql_free_result($resultcoloumn);
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
                intval( $_GET['iDisplayLength'] );
    }
    /*
    * Get Ordering DataTables
    */
    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= "`".$var1[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
                ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
            }
        }

        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
    /*
    * Get Where DataTables
     */
    $sWhere = "";
    if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($var1) ; $i++ )
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .= $var1[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
    
    /* Individual column filtering */
    for ( $i=0 ; $i<count($var1) ; $i++ )
    {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $var1[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }
    /* Showing Data With Variable Field PHP */
    $sQuery1 = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $var1))."
        FROM (";
    $sQuery1 .= "Select @row := @row+1 `No`, a.*, namagroup, iduser Action From userlogin a, "
        . "(Select @row := 0) p, groupuser g Where g.idgroup = a.idgroup";
    $sQuery1 .= ") a";
    $sQuery1 .= " $sWhere
        $sOrder
        $sLimit";
    $result = mysql_query($sQuery1);
    $sQuery = "Select Count(p.iduser) Jml From (Select @row := @row+1 `No`, a.*, namagroup, iduser Action "
        . "From userlogin a, (Select @row := 0) p, groupuser g Where g.idgroup = a.idgroup) p ";
    $sQuery .= " $sWhere";
    $rResultFilterTotal = mysql_query($sQuery);
    $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];
    
    $iTotal = mysql_num_rows($result);

    $numberfields = mysql_num_fields($result);
    
    $var = array();
    for ($i=0; $i<$numberfields ; $i++ ) {
       $var[] = mysql_field_name($result, $i);
    }


    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

    while($row = mysql_fetch_array($result)){
        $row1 = array();
        for ( $i=0 ; $i<count($var) ; $i++ )
        {
            /* General output */
            $row1[$var[$i]] = $row[$var[$i]];
        }
        $output['aaData'][] = $row;
    }
    echo json_encode($output);
?>