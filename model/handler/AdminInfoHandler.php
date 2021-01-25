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


}