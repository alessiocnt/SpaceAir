<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class PacketHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function insertPacket($packet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();

        if ($insert_stmt = $db->prepare("INSERT INTO PACKET (DateTimeDeparture, DateTimeArrival, Price, MaxSeats, Description, CodPlanet, Visible) VALUES (?, ?, ?, ?, ?, ?, ?);")) {    
            $dateTimeDeparture = $packet->getDepartureDateHour()->format('Y-m-d H:i:s');
            $dateTimeArrival = $packet->getArriveDateHour()->format('Y-m-d H:i:s');
            $price = $packet->getPrice();
            $maxSeats = $packet->getMaxSeats();
            $description = $packet->getDescription();
            $codPlanet = $packet->getDestinationPlanetId();
            $visible = $packet->isVisible();
            
            $insert_stmt->bind_param('ssdisii', $dateTimeDeparture, $dateTimeArrival, $price, $maxSeats, $description, $codPlanet, $visible);
            $insert_stmt->execute();
            return true;
        }
        return false;
    }

    public function getPackets() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PACKETS WHERE Visible = true");
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);
        
        $builder = new PacketBuilder();
        $packets = array();
        foreach ($result as $packet) {
            array_push($packets,$builder->createFromAssoc($packet));
        }
        return $packets;
    }
}

?>