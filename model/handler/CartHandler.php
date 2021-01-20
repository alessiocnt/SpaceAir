<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class CartHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getCart() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT PACKET.*, PACKET_IN_ORDER.Quantity, PLANET.Img, PLANET.Name
        FROM PACKET JOIN PACKET_IN_ORDER ON PACKET.CodPacket = PACKET_IN_ORDER.CodPacket JOIN ORDERS ON ORDERS.CodOrder = PACKET_IN_ORDER.CodOrder JOIN planet ON PLANET.CodPlanet = PACKET.CodPlanet
        WHERE ORDERS.PurchaseDate IS NULL AND ORDERS.IdUser = ?");
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);

        $builder = new PacketBuilder();
        $packets = array();
        
        foreach ($result as $packet) {
            $packet["DateTimeDeparture"] = DateTime::createFromFormat("Y-m-d H:i:s", $packet["DateTimeDeparture"])->format('Y-m-j\TH:i');
            $packet["DateTimeArrival"] = DateTime::createFromFormat("Y-m-d H:i:s", $packet["DateTimeArrival"])->format('Y-m-j\TH:i');
            array_push($packets, array("packet"=>$builder->createFromAssoc($packet), "quantity"=>$packet["Quantity"], "planetName"=>$packet["Name"]));
        }
        return $packets;
    }
}

?>