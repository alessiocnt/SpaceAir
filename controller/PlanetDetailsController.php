<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PlanetDetailsController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        $packetHandler = $this->getModel()->getPacketHandler();
        $reviewHandler = $this->getModel()->getReviewHandler();
        
        if(isset($_GET["Destination"])) {
            if($planetHandler->searchPlanetByName($_GET["Destination"]) != false) {
                $destinationName = $_GET["Destination"];
                $planet = $planetHandler->searchPlanetByName($destinationName)[0];
                $data["data"]["planets"] = $planet;
                $data["data"]["packets"] = $packetHandler->getPacketsByDestination($planet);
                $data["data"]["packet"] = $reviewHandler->getReviewByDestination($planet);
                $data["header"]["title"] = "Dettagli Destinazione";
                $data["header"]["js"] = ["/spaceair/view/js/planetdetails.js"];
                $data["header"]["css"] = [];
                $view = new GenericView("planetdetails");
                $view->render($data); 
            } else {
                $data["data"]["error"] = "Errore, destinazione non trovata.";
                $data["data"]["planets"] = $planetHandler->getPlanets();
                $data["header"]["title"] = "Destinazioni";
                $data["header"]["js"] = ["/spaceair/view/js/destinations.js"];
                $data["header"]["css"] = [];
                $view = new GenericView("destinations");
                $view->render($data);
            }
        }

    }
}
?>

