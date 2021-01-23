<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PacketListController extends AdminLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $packetHandler = $this->getModel()->getPacketHandler();
        $planetHandler = $this->getModel()->getPlanetHandler();
        $packets = $packetHandler->getPackets();
        foreach ($packets as $packet) {
            $packet->setDestinationPlanet($planetHandler->searchPlanetByCod($packet->getDestinationPlanetId())[0]);
            $packet->setAviableSeats($packetHandler->getAviableSeats($packet));
        }

        $data["data"]["packets"] = $packets;
        //Set the title
        $data["header"]["title"] = "Elenco Viaggi";
        //Set custom js
        $data["header"]["js"] = ["/spaceair/view/js/packetlist.js"];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new GenericView("packetlist");
        //Render the view
        $view->render($data); 
    }

}