<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();



if(!isset($_POST['planet'])) {
    echo json_encode(array("data"=>"Errore nella rimozione."));
    return;
}

if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER)) {
    echo json_encode(array("data" => "Not logged"));
    return;
}

$user = Utils::getUserId();
$planet = $_POST['planet'];
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
