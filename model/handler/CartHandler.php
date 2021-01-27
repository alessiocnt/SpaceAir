<?php 



class CartHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getCart($user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT P.*, PIO.Quantity, PIO.CodOrder
        FROM PACKET P JOIN (
            SELECT PIO.Quantity, PIO.CodPacket, PIO.CodOrder
            FROM PACKET_IN_ORDER PIO JOIN (
                SELECT O.CodOrder
                FROM ORDERS O
                WHERE O.PurchaseDate IS NULL && O.IdUser = ?
            ) C ON PIO.CodOrder = C.CodOrder
        ) PIO ON P.CodPacket = PIO.CodPacket && PIO.Quantity > 0 && P.Visible = 1
        ");
        $userId = $user->getId();
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return new Order(0);
        }
        $builder = new PacketBuilder();
        $packetHandler = new PacketHandler(new ModelImpl());
        $planetHandler = new PlanetHandler(new ModelImpl());
        $orderHandler = new OrderHandler(new ModelImpl());
        $order = new Order($result[0]["CodOrder"]);
        foreach ($result as $packet) {
            $pck = $builder->createFromAssoc($packet);
            $planet = $planetHandler->searchPlanetByCod($pck->getDestinationPlanetId())[0];
            $pck->setDestinationPlanet($planet);
            $pck->setAvailableSeats($packetHandler->getAvailableSeats($pck));
            $order->pushPacket(array($pck, $packet["Quantity"]));
            $order->setTotal($orderHandler->getTotal($order));
            //array_push($packets, array("packet"=>$pck,"codOrder"=>$packet["CodOrder"], "quantity"=>$packet["Quantity"], "planetName"=>$packet["Name"]));
        }
        return $order;
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
        $stmt = $db->prepare("SELECT Quantity FROM PACKET_IN_ORDER WHERE CodPacket = ? AND CodOrder = ?");
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