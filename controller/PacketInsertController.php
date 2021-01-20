<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PacketInsertController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $packetHandler = $this->getModel()->getPacketHandler();
        
        if(isset($_POST["inputDepartureDateHour"])) {
            //var_dump($_POST);
            $data["CodPlanet"] = $_POST["inputDestination"];
            /* $data["imgPlanet"] = $_POST["inputImage"]; */
            $data["DateTimeDeparture"] = $_POST["inputDepartureDateHour"];
            $data["DateTimeArrival"] = $_POST["inputArriveDateHour"];
            $data["MaxSeats"] = $_POST["inputCapacity"];
            $data["AviableSeats"] = $data["MaxSeats"];
            $data["Price"] = $_POST["inputPrice"];
            $data["Description"] = $_POST["inputDescription"];
            $data["Visible"] = $_POST["inputVisible"] == "on" ? 1 : 0;
            var_dump($data);

            $builder = new PacketBuilder();
            $packet = $builder->createFromAssoc($data);
            
            $result = $packetHandler->insertPacket($packet);
            
            if($result == true) {
                echo("Pacchetto inserito correttamente.");
            } else {
                $data["data"]["error"] = "Errore di inserimento.";
                $data["header"]["title"] = "Nuovo pacchetto";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("packetinsert");
                $view->render($data); 
            }
        } else {
            $planetHandler = $this->getModel()->getPlanetHandler();
            $data["data"]["planets"] = $planetHandler->getPlanets();
            $data["header"]["title"] = "Nuovo pacchetto";
            $data["header"]["js"] = [];
            $data["header"]["css"] = [];
            $view = new GenericView("packetinsert");
            $view->render($data); 
        }
    }
}
?>