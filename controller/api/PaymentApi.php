<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
$orderHandler = $model->getOrderHandler();
$packetHandler = $model->getPacketHandler();
$userInfoHandler = $model->getUserInfoHandler();
$planetHandler = $model->getPlanetHandler();

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

$addr = new Address($_POST["addr"]);
$order = $orderHandler->getOrderById($cod);
$total = $orderHandler->getTotal($order);


$user = $model->getUserHandler()->getUserById(Utils::getUserId());
$user->setAddresses($model->getUserInfoHandler()->getAddresses($user));

$ok = true;
$packets = $orderHandler->getPackets($order);
foreach ($packets as $packet) {
    $packet->setAvailableSeats($packetHandler->getAvailableSeats($packet));
    $order->pushPacket($packet);
}


$admin = $userInfoHandler->getAdmin();

if($orderHandler->checkAvailable($order, $user, $admin)) {
    if($orderHandler->purchaseOrder($order, $user, $total, $addr)) {
        echo "Acquisto effettuato";
        $descUser = "Hai acquistato i seguenti pacchetti ";
        $descAdmin = "Sono stati acquistati i seguenti pacchetti ";
        foreach ($order->getPackets() as $packet) {
            $descUser = $descUser."Viaggio verso ".$planetHandler->searchPlanetByCod($packet->getDestinationPlanet()->getCodPlanet())[0]->getName();
            $descAdmin = $descAdmin."Viaggio verso ".$planetHandler->searchPlanetByCod($packet->getDestinationPlanet()->getCodPlanet())[0]->getName();
        }
        $descUser.=" per un totale di ".$total;
        $descAdmin.=" per un totale di ".$total;
        $notificationDispatcher = new NotificationDispatcher(new ModelImpl());
        $notificationDispatcher->createGeneral("Acqusto effettuato", $descUser, array($user));
        $notificationDispatcher->createGeneral("Nuovo ordine evaso", $descAdmin, array($admin));
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
