<?php
$panel = true;
include_once("../../system/Bahadir.php");

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

<<<<<<< HEAD
    case 'CHANGE_STATE':

        $ID = $bahadir->fnc->post("ID");
        $STATE = $bahadir->fnc->post("STATE");
        $UPDATE_STATE = $bahadir->mssqlDb->ExexQuery("UPDATE SLIDER SET VISIBILITY = $STATE WHERE ID = $ID");

=======
    case 'SLIDER_STATE_CHANGED':
        $STATE = $bahadir->fnc->post("STATE");
        if($STATE == "true"){ $STATE = 1; } else { $STATE = 0; }
        $ID = $bahadir->fnc->post("ID");
        $bahadir->mssqlDb->ExexQuery("UPDATE SLIDER SET VISIBILITY = $STATE WHERE ID = $ID");
        echo json_encode(array("STATE"=>$STATE,"ID"=>$ID)) ;
>>>>>>> origin/master
        break;
}
?>