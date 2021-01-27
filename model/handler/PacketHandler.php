<?php 



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
            return $db->insert_id;
        }
        return false;
    }

    public function updatePacket($packet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE PACKET SET DateTimeDeparture = ?, DateTimeArrival = ?, Price = ?, MaxSeats = ?, Description = ?, CodPlanet = ?, Visible = ?  WHERE CodPacket = ?");
        $codPacket = $packet->getCode();
        $codPlanet = $packet->getDestinationPlanet()->getCodPlanet();
        $dateTimeDeparture = $packet->getDepartureDateHour()->format('Y-m-d H:i:s');
        $dateTimeArrival = $packet->getArriveDateHour()->format('Y-m-d H:i:s');
        $price = $packet->getPrice();
        $maxSeats = $packet->getMaxSeats();
        $description = $packet->getDescription();
        $visible = $packet->isVisible();
        if(!$stmt->bind_param("ssiisiii", $dateTimeDeparture, $dateTimeArrival, $price, $maxSeats, $description, $codPlanet, $visible, $codPacket)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        return true;
    }

    public function getPacketById($id) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PACKET WHERE Visible = true AND CodPacket = ?");
        if(!$stmt->bind_param("i", $id)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(!count($result)) {
            return false;
        }
        
        $builder = new PacketBuilder();
        foreach ($result as $val) {
            return $builder->createFromAssoc($val);
        }
        //return $builder->createFromAssoc($result[0]);
    }

    public function getAllPacketsById($id) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PACKET WHERE CodPacket = ?");
        if(!$stmt->bind_param("i", $id)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(!count($result)) {
            return false;
        }
        
        $builder = new PacketBuilder();
        foreach ($result as $val) {
            return $builder->createFromAssoc($val);
        }
        //return $builder->createFromAssoc($result[0]);
    }

    public function getPackets() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PACKET WHERE Visible = true AND DateTimeDeparture > NOW()");
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

    public function getAllPackets() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PACKET WHERE DateTimeDeparture > NOW()");
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

    public function getAvailableSeats($packet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT SUM(PIO.Quantity) AS Venduti
        FROM PACKET_IN_ORDER PIO JOIN ORDERS O ON PIO.CodOrder = O.CodOrder JOIN PACKET P ON P.CodPacket = PIO.CodPacket
        WHERE O.PurchaseDate IS NOT NULL AND P.CodPacket = ?");
        $packetId = $packet->getCode();
        if(!$stmt->bind_param("i", $packetId)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            $venduti = 0;
        } else {
            $venduti = $result[0]["Venduti"];
        }
        $disp = $packet->getMaxSeats() - $venduti;
        return $disp < 0 ? 0 : $disp;
    }

    public function getPacketsByDestination($destination) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PACKET WHERE CodPlanet = ? AND Visible = true AND DateTimeDeparture > NOW()");
        $planetId = $destination->getCodPlanet();
        $stmt->bind_param("i", $planetId);
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);

        $builder = new PacketBuilder();
        $packets = array();
        foreach ($result as $pkt) {
            $pack = $builder->createFromAssoc($pkt);
            $pack->setAvailableSeats($this->getAvailableSeats($pack));
            array_push($packets, $pack);
        }
        return $packets;
    }

}

?>