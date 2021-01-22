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
        $sql = "SELECT O.CodOrder, O.PurchaseDate, O.Total, O.State, S.Description AS StateDescription, PCKO.Quantity, PCK.DateTimeDeparture, PCK.DateTimeArrival, PCK.Price, PCK.MaxSeats, PCK.Description, P.Name AS PlanetName, P.Img   FROM ORDERS O, PACKET_IN_ORDER PCKO, PACKET PCK, PLANET P, ORDER_STATE S WHERE PCKO.CodOrder = O.CodOrder AND PCKO.CodPacket = PCK.CodPacket AND PCK.CodPlanet = P.CodPlanet AND O.State = S.CodState AND O.PurchaseDate IS NOT NULL AND O.IdUser = ? ORDER BY O.CodOrder, PCK.DateTimeDeparture";   
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
        $sql = "SELECT O.CodOrder, O.Total, PCKO.Quantity, PCK.DateTimeDeparture, PCK.DateTimeArrival, PCK.Price, PCK.MaxSeats, PCK.Description, P.Name AS PlanetName, P.Img FROM ORDERS O, PACKET_IN_ORDER PCKO, PACKET PCK, PLANET P WHERE PCKO.CodOrder = O.CodOrder AND PCKO.CodPacket = PCK.CodPacket AND PCK.CodPlanet = P.CodPlanet AND O.CodOrder = ? ORDER BY PCK.DateTimeDeparture";
        if($stmt = $db->prepare($sql)) {
            $orderId = $order->getCodOrder();
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);

            $packetBuilder = new PacketBuilder();
            $orderDetailed = new Order($order->getCodOrder());
            foreach($results as $result) {
                $packet = $packetBuilder->createFromAssoc($result);
                $packet->setDestinationPlanet(new Planet(0, $result["PlanetName"], $result["Img"]));
                $orderDetailed->pushPacket($packet);
            }

            return $orderDetailed;
        }

        return false;
    }
    
}



?>