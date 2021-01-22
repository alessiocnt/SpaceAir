<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
$planetHandler = $model->getPlanetHandler();

if(!isset($_SESSION["user_id"])) {
    $res = json_encode(array("msg"=>"Effettua il login per sbloccare questa funzione."));
} else {
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
}
echo($res);

?>
