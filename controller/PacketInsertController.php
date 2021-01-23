<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PacketInsertController extends AdminLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $packetHandler = $this->getModel()->getPacketHandler();
        
        if(isset($_POST["inputDepartureDateHour"])) {
            //var_dump($_POST);
            $data["CodPlanet"] = $_POST["inputDestination"];
            /* $data["imgPlanet"] = $_POST["inputImage"]; */

            $data["DateTimeDeparture"] = DateTime::createFromFormat("Y-m-j\TH:i", $_POST["inputDepartureDateHour"])->format('Y-m-d H:i:s');
            var_dump($data["DateTimeDeparture"]);
            $data["DateTimeArrival"] = DateTime::createFromFormat("Y-m-j\TH:i", $_POST["inputArriveDateHour"])->format('Y-m-d H:i:s');
            $data["MaxSeats"] = $_POST["inputCapacity"];
            $data["AviableSeats"] = $data["MaxSeats"];
            $data["Price"] = $_POST["inputPrice"];
            $data["Description"] = $_POST["inputDescription"];
            $data["Visible"] = $_POST["inputVisible"] == "on" ? 1 : 0;

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