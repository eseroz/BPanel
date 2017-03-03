<?php
$panel = true;
include_once("../system/Bahadir.php");

$option = $bahadir->fnc->post("OPTION");

switch ($option)
{
    case 'SLIDER_SEQUENCE':
        $LIST = json_decode($_POST["LISTE"]);
        for ($i = 0; $i < count($LIST); $i++)
        {
            $ID = $LIST[$i][0];
            $SEQUENCE = $LIST[$i][1];
            $bahadir->mssqlDb->ExexQuery("UPDATE SLIDER SET SEQUENCE = $SEQUENCE WHERE ID = $ID");
        }
        echo json_encode(array(count($LIST)));
        break;
}
?>