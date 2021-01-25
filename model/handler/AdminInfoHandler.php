<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class AdminInfoHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    /*
        Get Packet sold for each planet
    */  
    public function getSalesPerPlanet() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $sql = "SELECT P.CodPlanet, P.Name, SUM(PAO.Quantity) AS Quantity FROM ORDERS O, PACKET_IN_ORDER PAO, PACKET PA, PLANET P WHERE O.State != 1 AND PAO.CodOrder = O.CodOrder AND PAO.CodPacket = PA.CodPacket AND PA.CodPlanet = P.CodPlanet GROUP BY P.CodPlanet, P.Name";
        $array = array();
        if($stmt = $db->prepare($sql)) {
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);

            foreach($results as $result) {
                array_push($array, array("planet" => $result["Name"], "quantity" => $result["Quantity"]));
            } 
        }

        return $array;
    }

    public function getPopularPackets() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $sql = "SELECT PA.CodPacket, P.Name, PA.DateTimeDeparture, SUM(PAO.Quantity) AS Quantity FROM ORDERS O, PACKET_IN_ORDER PAO, PACKET PA, PLANET P WHERE O.State != 1 AND PAO.CodOrder = O.CodOrder AND PAO.CodPacket = PA.CodPacket AND PA.CodPlanet = P.CodPlanet GROUP BY PA.CodPacket, P.Name ORDER BY Quantity DESC LIMIT 10";
        
        $array = array();
        if($stmt = $db->prepare($sql)) {
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);

            foreach($results as $result) {
                array_push($array, array("planet" => $result["Name"], "date" => date("d/m/Y",strtotime($result["DateTimeDeparture"])), "quantity" => $result["Quantity"]));
            } 
        }

        return $array;
    }


    public function getActualPassenger(Packet $packet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $sql = "SELECT U.CodUser, U.Name, U.Surname, PO.Quantity FROM PACKET P, PACKET_IN_ORDER PO, ORDERS O, USERS U WHERE P.CodPacket = PO.CodPacket AND PO.CodOrder = O.CodOrder AND O.IdUser = U.IdUser AND O.State != 1 AND P.CodPacket = ?";

        $array = array();
        if($stmt = $db->prepare($sql)) {
            $packetId = $packet->getCode();
            $stmt->bind_param("i", $packetId);
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);
            $builder = new UserBuilder();

            foreach($results as $result) {
                array_push($array, array("user" => $builder->createFromAssoc($result), "quantity" => $result["Quantity"]));
            }
        }

        return $array;
    }
}