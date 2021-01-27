<?php

require_once("./UserLoggedApi.php");

$planetHandler = $model->getPlanetHandler();
if(!isset($_POST['planet'])) {
    echo json_encode(array("data"=>"Errore nella rimozione."));
    return;
}

if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER)) {
    echo json_encode(array("data" => "Not logged"));
    return;
}

$user = Utils::getUserId();
$planet = $planetHandler->searchPlanetByCod($_POST["planet"])[0];
$userInfoHandler = $model->getUserInfoHandler();
$user = $model->getUserHandler()->getUserById(Utils::getUserId());

if($userInfoHandler->removeUserInterest($user, $planet)) {
    echo json_encode(array("data" => "Rimosso dai preferiti con successo"));
    return;
} else {
    echo json_encode(array("data" => "Non è stato possibile rimuovere l'elemento"));
    return;
}

?>
