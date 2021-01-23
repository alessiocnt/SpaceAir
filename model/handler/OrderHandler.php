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

    public function purchaseOrder($order, $user, $total) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE ORDERS SET PurchaseDate = NOW(), DestAddressCode = ?, State = 1, Total = ? WHERE CodOrder = ? AND IdUser = ?");
        $address = $user->getAddresses()[0]->getCodAddress();
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

    public function checkAvailable($order) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        foreach ($order->getPackets() as $packet) {
            $stmt = $db->prepare("SELECT SUM(PIO.Quantity) AS Venduti
            FROM PACKET_IN_ORDER PIO JOIN ORDERS O ON PIO.CodOrder = O.CodOrder JOIN PACKET P ON P.CodPacket = PIO.CodPacket
            WHERE O.PurchaseDate IS NOT NULL AND P.CodPacket = ?");
            $codPacket = $packet->getCode();
            if(!$stmt->bind_param("i", $codPacket)) {
                return false;
            }
            if(!$stmt->execute()) {
                return false;
            }
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $venduti = $result[0]["Venduti"];
            /*echo 'venduti';
            var_dump($venduti);
            echo 'aviable';
            var_dump($packet->getAviableSeats());
            echo 'quantita';*/
            var_dump($this->getPacketQuantityInOrder($order, $packet));
            if($this->getPacketQuantityInOrder($order, $packet) != null && $venduti + $this->getPacketQuantityInOrder($order, $packet) > $packet->getAviableSeats()) {
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

}

?>