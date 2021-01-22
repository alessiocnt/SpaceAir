<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
$orderHandler = $model->getOrderHandler();

if(!isset($_POST['codOrder'])) {
    echo json_encode(array("msg"=>"ko", "data"=>"Errore nell'acquisto."));
    return;
}

if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER)) {
    echo json_encode(array("msg"=>"ko", "data" => "Not logged"));
    return;
}

$user = Utils::getUserId();
$cod = $_POST['codOrder'];


$order = $orderHandler->getOrderById($cod);


$user = $model->getUserHandler()->getUserById(Utils::getUserId());
$user->setAddresses($model->getUserInfoHandler()->getAddresses($user));

if($orderHandler->checkAvailable($order)) {
    if($orderHandler->purchaseOrder($order, $user)) {
        echo json_encode(array("msg"=>"Acquisto effettuato"));
        return;
    } else {
        echo json_encode(array("msg"=>"Non è stato possibile acquistare l'elemento"));
        return;
    }

} else {
    echo json_encode(array("msg"=>"Posti disponibili insufficienti"));
    return;
}

?>
