<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/api/UserLoggedApi.php");

$planetHandler = $model->getPlanetHandler();
$user = $_SESSION["user_id"];
$planet = $planetHandler->searchPlanetByName($_POST["planet"])[0];
if(!$planetHandler->findFavourite($user, $planet)){

    if($planetHandler->addFavourite($user, $planet)) {
        $res = json_encode(array("msg"=>"Aggiunta avvenuta con successo."));
    } else {
        $res = json_encode(array("msg"=>"Errore nell'aggiunta ai preferiti."));
    }
} else {
    if($planetHandler->updateFavourite($user, $planet)) {
        $res = json_encode(array("msg"=>"Aggiunta avvenuta con successo."));
    } else {
        $res = json_encode(array("msg"=>"Errore nell'aggiunta ai preferiti."));
    }
}
echo($res);

?>
