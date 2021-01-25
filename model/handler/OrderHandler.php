<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class OrderHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }


    public function getOrderById($id) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT CodOrder FROM ORDERS WHERE CodOrder = ?");
        if(!$stmt->bind_param("i", $id)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);
        $builder = new OrderBuilder();
        foreach ($result as $val) {
            return $builder->createFromAssoc($val);
        }
    }

    public function getPackets($order) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT CodPacket FROM PACKET_IN_ORDER WHERE CodOrder = ?");
        $codOrder = $order->getCodOrder();
        if(!$stmt->bind_param("i", $codOrder)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);
        $handler = new PacketHandler($this->getModelHelper());
        $packets = array();
        foreach ($result as $val) {
            array_push($packets, $handler->getPacketById($val["CodPacket"]));
        }
        return $packets;
    }

    public function purchaseOrder($order, $user, $total, $addr) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE ORDERS SET PurchaseDate = NOW(), DestAddressCode = ?, State = 2, Total = ? WHERE CodOrder = ? AND IdUser = ?");
        $address = $addr->getCodAddress();
        $userId = $user->getId();
        $codOrder = $order->getCodOrder();
        if(!$stmt->bind_param("iiii", $address, $total,  $codOrder, $userId)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        return true;
    }

    public function checkAvailable($order, $user, $admin) {
        foreach ($order->getPackets() as $packet) {
            if($this->getPacketQuantityInOrder($order, $packet) != null && $this->getPacketQuantityInOrder($order, $packet) > $packet->getAvailableSeats()) {
                $planetHandler = new PlanetHandler(new ModelImpl());
                $descUser = "Posti disponibili insufficienti per il viaggio verso ".$planetHandler->searchPlanetByCod($packet->getDestinationPlanet()->getCodPlanet())[0]->getName();
                $descAdmin = "Disponibilità posti limitata per il viaggio verso ".$planetHandler->searchPlanetByCod($packet->getDestinationPlanet()->getCodPlanet())[0]->getName()." in partenza il ".$packet->getDepartureDateHour()->format("d-m-Y");
                $notificationDispatcher = new NotificationDispatcher(new ModelImpl());
                $notificationDispatcher->createGeneral("Acquisto non effettuato", $descUser, array($user));
                $notificationDispatcher->createGeneral("Posti in esaurimento ", $descAdmin, array($admin));
                return false;
            }
        }
        return true;
    }

    private function getPacketQuantityInOrder($order, $packet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT Quantity
        FROM PACKET_IN_ORDER
        WHERE CodOrder = ? AND CodPacket = ?");
        $codPacket = $packet->getCode();
        $codOrder = $order->getCodOrder();
        if(!$stmt->bind_param("ii", $codOrder, $codPacket)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result[0]["Quantity"];
    }

    public function getTotal($order) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT SUM((Price * Quantity)) as Totale
        FROM PACKET_IN_ORDER PIO JOIN PACKET P ON PIO.CodPacket = P.CodPacket
        WHERE PIO.CodOrder = ?");
        $codOrder = $order->getCodOrder();
        if(!$stmt->bind_param("i", $codOrder)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result[0]["Totale"];
    }

}
