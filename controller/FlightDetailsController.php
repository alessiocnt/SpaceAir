<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class FlightDetailsController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        $userHandler = $this->getModel()->getUserHandler();
        $packetHandler = $this->getModel()->getPacketHandler();
        
        if(isset($_GET["Destination"]) && isset($_GET["Packet"])) {
            if($planetHandler->searchPlanetByName($_GET["Destination"]) != false) {
                $data["data"]["planets"] = $planetHandler->searchPlanetByName($_GET["Destination"])[0];
                $data["data"]["user"] = $userHandler->getUserById(Utils::getUserId());
                $packet = $packetHandler->getPacketById($_GET["Packet"]);
                $packet->setAvailableSeats($packetHandler->getAvailableSeats($packet));
                $data["data"]["packet"] = $packet;
                $data["header"]["title"] = "Dettagli Volo";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("flightdetails");
                $view->render($data); 
            } else {
                $data["data"]["error"] = "Errore, destinazione non trovata.";
                $data["header"]["title"] = "Destinazioni";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("flightdetails");
                $view->render($data); 
            }
        }

    }
}
?>

