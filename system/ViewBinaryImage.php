<?php
$panel = true;
include_once("Bahadir.php");

$OPTION = $bahadir->fnc->get("OPTION");
$ID = $bahadir->fnc->get("ID");

switch ($OPTION)
{
    case 'SLIDER':

        $sql = "SELECT *FROM SLIDER WHERE ID = $ID";
        $query = odbc_exec($bahadir->mssqlDb->mssqlCon, $sql);

        while($row = odbc_fetch_array( $query )){
            header("Content-type:image/png");
            $byte_array = $row["IMAGE_BINARY"];
            echo $byte_array;
        }

        break;
}
?>