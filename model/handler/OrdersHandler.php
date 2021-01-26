<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class OrdersHandler extends AbstractHandler {

   public function __construct(ModelHelper $model) {
      parent::__construct($model);
   }

   /*
      get all the orders of a user
   */
    public function getOrders(User $user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $sql = "SELECT O.CodOrder, O.PurchaseDate, O.Total, O.State, S.Description AS StateDescription, PCKO.Quantity, PCK.DateTimeDeparture, PCK.DateTimeArrival, PCK.Price, PCK.MaxSeats, PCK.Description, P.Name AS PlanetName, P.Img   FROM ORDERS O, PACKET_IN_ORDER PCKO, PACKET PCK, PLANET P, ORDER_STATE S WHERE O.State != 1 AND PCKO.CodOrder = O.CodOrder AND PCKO.CodPacket = PCK.CodPacket AND PCK.CodPlanet = P.CodPlanet AND O.State = S.CodState AND O.PurchaseDate IS NOT NULL AND PCKO.Quantity > 0 AND O.IdUser = ? ORDER BY O.CodOrder, PCK.DateTimeDeparture";   
        if($stmt = $db->prepare($sql)) {
            $userId = $user->getId();
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);

            $currentOrderId = 0;
            $orderBuilder = new OrderBuilder();
            $packetBuilder = new PacketBuilder();
            $currentOrder;
            $array = array();
            foreach($results as $result) {
                if($result["CodOrder"] != $currentOrderId) {
                    //New order
                    $currentOrder = $orderBuilder->createFromAssoc($result);
                    $state = new OrderState($result["State"], $result["StateDescription"]);
                    $currentOrder->setState($state);
                    $currentOrderId = $result["CodOrder"];
                    array_push($array, $currentOrder);
                }

                $packet = $packetBuilder->createFromAssoc($result);
                $packet->setDestinationPlanet(new Planet(0, $result["PlanetName"]));
                $currentOrder->pushPacket($packet);
            }

            return $array;
        }

        return false;
    }

    public function getOrderDetail(Order $order) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $sql = "SELECT O.CodOrder, O.IdUser, O.Total, PCKO.Quantity, PCK.DateTimeDeparture, PCK.CodPacket, PCK.DateTimeArrival, PCK.Price, PCK.MaxSeats, PCK.Description, P.Name AS PlanetName, P.Img FROM ORDERS O, PACKET_IN_ORDER PCKO, PACKET PCK, PLANET P WHERE PCKO.CodOrder = O.CodOrder AND PCKO.CodPacket = PCK.CodPacket AND PCK.CodPlanet = P.CodPlanet AND O.State != 1 AND PCKO.Quantity > 0 AND O.CodOrder = ? ORDER BY PCK.DateTimeDeparture";
        if($stmt = $db->prepare($sql)) {
            $orderId = $order->getCodOrder();
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);

            $packetBuilder = new PacketBuilder();
            $orderDetailed = new Order($order->getCodOrder());
            if(count($results) > 0) {
                $orderDetailed->setUser(new User($results[0]["IdUser"]));
            }

            foreach($results as $result) {
                $packet = $packetBuilder->createFromAssoc($result);
                $packet->setDestinationPlanet(new Planet(0, $result["PlanetName"], $result["Img"]));
                $orderDetailed->pushPacket(new OrderPacket($packet, $result["Quantity"]));
            }

            return $orderDetailed;
        }

        return false;
    }

    /*
        Get all the info on a Packet ordered by a User.
    */
    public function getPacketInOrderDetails(Packet $packet, Order $order) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $sql = "SELECT PCKO.Quantity, PCK.DateTimeDeparture, PCK.CodPacket, PCK.DateTimeArrival, PCK.Price, PCK.Description, P.Name AS PlanetName, P.Img FROM PACKET_IN_ORDER PCKO, PACKET PCK, PLANET P WHERE PCKO.CodPacket = PCK.CodPacket AND PCK.CodPlanet = P.CodPlanet AND PCKO.CodOrder = ? AND PCK.CodPacket = ? LIMIT 1";
        if($stmt = $db->prepare($sql)) {
            $orderId = $order->getCodOrder();
            $packetId = $packet->getCode();
            $stmt->bind_param("ii", $orderId, $packetId);
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_all(MYSQLI_ASSOC)[0];

            $packetBuilder = new PacketBuilder();
            $newpacket = $packetBuilder->createFromAssoc($result);
            $newpacket->setDestinationPlanet(new Planet(0, $result["PlanetName"], $result["Img"]));

            //Return packet with all the info and the quantity
            return new OrderPacket($newpacket, $result["Quantity"]);
        }

        return false;
    }

    public function getInProgressOrders() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $sql = "SELECT O.CodOrder, U.IdUser, U.Name, U.Surname, OS.CodState, OS.Description FROM ORDERS O, USERS U, ORDER_STATE OS WHERE O.State NOT IN(1,4) AND O.IdUser = U.IdUser AND O.State = OS.CodState ORDER BY O.CodOrder";   
        if($stmt = $db->prepare($sql)) {            
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);

            $orderBuilder = new OrderBuilder();
            $userBuilder = new UserBuilder();
            $array = array();
            foreach($results as $result) {
                //New order
                $order = $orderBuilder->createFromAssoc($result);
                $user = $userBuilder->createFromAssoc($result);
                $order->setUser($user);
                $state = new OrderState($result["CodState"], $result["Description"]);
                $order->setState($state);
                array_push($array, $order);
            }
            
            return $array;
        }

        return false;
    }
    
}



?>