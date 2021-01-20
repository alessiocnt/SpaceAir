<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
$planetHandler = $model->getPlanetHandler();

if(!isset($_SESSION["user_id"])) {
    $res = json_encode(array("msg"=>"Effettua il login."));
} else {
    $user = $_SESSION["user_id"];
    $planet = $planetHandler->searchPlanetByName($_POST["planet"])[0];
    if($planetHandler->hidePlanet($planet)) {
        $res = json_encode(array("msg"=>"Rimozione avvenuta con successo."));
    } else {
        $res = json_encode(array("msg"=>"Errore nella rimozione."));
    }
} 
echo($res);

?>
