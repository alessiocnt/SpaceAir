<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class CartHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getCart() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT PACKET.*, PACKET_IN_ORDER.Quantity, PACKET_IN_ORDER.CodOrder, PLANET.Img, PLANET.Name
        FROM PACKET JOIN PACKET_IN_ORDER ON PACKET.CodPacket = PACKET_IN_ORDER.CodPacket JOIN ORDERS ON ORDERS.CodOrder = PACKET_IN_ORDER.CodOrder JOIN PLANET ON PLANET.CodPlanet = PACKET.CodPlanet
        WHERE ORDERS.PurchaseDate IS NULL AND PACKET_IN_ORDER.Quantity > 0 AND ORDERS.IdUser = ?");
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);

        $builder = new PacketBuilder();
        $packets = array();
        
        foreach ($result as $packet) {
            array_push($packets, array("packet"=>$builder->createFromAssoc($packet),"codOrder"=>$packet["CodOrder"], "quantity"=>$packet["Quantity"], "planetName"=>$packet["Name"]));
        }
        return $packets;
    }

    public function changeQuantity($id, $quantity, $order) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE PACKET_IN_ORDER SET Quantity = ? WHERE CodPacket = ? AND CodOrder = ?");
        $stmt->bind_param("iii", $quantity, $id, $order);
        $stmt->execute();
    }

    private function findOrder($userId) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT CodOrder FROM ORDERS WHERE IdUser = ? AND PurchaseDate IS NULL");
        if (!$stmt->bind_param('i', $userId)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } else {
            return $result[0];
        }
    }

    public function getOrderId($userId) {
        $orderId = $this->findOrder($userId);
        if($orderId == false) {
            $db = $this->getModelHelper()->getDbManager()->getDb();
            $stmt = $db->prepare("INSERT INTO ORDERS (IdUser, State) VALUES (?, ?);");  
            $state = 1; 
            if (!$stmt->bind_param('ii', $userId, $state)) {
                return false;
            }
            if (!$stmt->execute()) {
                return false;
            }
            $orderId = $db->insert_id;
        }
        return $orderId;
    }

    private function existPacketinOrder($pktId, $orderId) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PACKET_IN_ORDER WHERE CodPacket = ? AND CodOrder = ?");
        if (!$stmt->bind_param('ii', $pktId, $orderId)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function addToCart($pktId, $orderId, $qty){
        $res = $this->existPacketinOrder($pktId, $orderId);
        /* var_dump($res); */
        if($res == false) {
            $db = $this->getModelHelper()->getDbManager()->getDb();
            $stmt = $db->prepare("INSERT INTO PACKET_IN_ORDER (CodPacket, CodOrder, Quantity) VALUES (?, ?, ?);");   
            if (!$stmt->bind_param('iii', $pktId, $orderId, $qty)) {
                return false;
            }
            if (!$stmt->execute()) {
                return false;
            }
            return true;
        } else {
            $db = $this->getModelHelper()->getDbManager()->getDb();
            $stmt = $db->prepare("SELECT Quantity FROM PACKET_IN_ORDER WHERE CodPacket = ? AND CodOrder = ?");
            $stmt->bind_param('ii', $pktId, $orderId);
            $stmt->execute();
            $actualQuantity = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["Quantity"];
            $newQuantity = intval($actualQuantity) + intval($qty);
            $db = $this->getModelHelper()->getDbManager()->getDb();
            $stmt = $db->prepare("UPDATE PACKET_IN_ORDER SET Quantity = ? WHERE CodPacket = ? AND CodOrder = ?");
            $stmt->bind_param("iii", $newQuantity, $pktId, $orderId);
            $stmt->execute();
            return true;
        }
    }

}

?>