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
            $pack["CodPlanet"] = $_POST["inputDestination"];
            /* $pack["imgPlanet"] = $_POST["inputImage"]; */

            $pack["DateTimeDeparture"] = DateTime::createFromFormat("Y-m-j\TH:i", $_POST["inputDepartureDateHour"])->format('Y-m-d H:i:s');
            $pack["DateTimeArrival"] = DateTime::createFromFormat("Y-m-j\TH:i", $_POST["inputArriveDateHour"])->format('Y-m-d H:i:s');
            $pack["MaxSeats"] = $_POST["inputCapacity"];
            $pack["AviableSeats"] = $pack["MaxSeats"];
            $pack["Price"] = $_POST["inputPrice"];
            $pack["Description"] = $_POST["inputDescription"];
            $pack["Visible"] = isset($_POST["inputVisible"]) ? 1 : 0;

            $builder = new PacketBuilder();
            $packet = $builder->createFromAssoc($pack);
            
            $result = $packetHandler->insertPacket($packet);
            
            if($result == true) {
                header("location:/spaceair/packetlist.php");
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