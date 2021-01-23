<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
$orderHandler = $model->getOrderHandler();
$packetHandler = $model->getPacketHandler();

if(!isset($_POST['codOrder'])) {
    echo 'Errore nell\'acquisto';
    return;
}

if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER)) {
    echo 'not logged';
    return;
}

$user = Utils::getUserId();
$cod = $_POST['codOrder'];


$order = $orderHandler->getOrderById($cod);
$total = $_POST["total"];


$user = $model->getUserHandler()->getUserById(Utils::getUserId());
$user->setAddresses($model->getUserInfoHandler()->getAddresses($user));

$ok = true;
$packets = $orderHandler->getPackets($order);
foreach ($packets as $packet) {
    $packet->setAviableSeats($packetHandler->getAviableSeats($packet));
    $order->pushPacket($packet);
}



if($orderHandler->checkAvailable($order)) {
    if($orderHandler->purchaseOrder($order, $user, $total)) {
        echo "Acquisto effettuato";
        return;
    } else {
        echo "Non è stato possibile acquistare l'elemento";
        return;
    }

} else {
    echo "Posti disponibili insufficienti";
    return;
}

?>
