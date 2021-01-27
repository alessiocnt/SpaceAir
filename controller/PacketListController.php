<?php

class PacketListController extends AdminLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $packetHandler = $this->getModel()->getPacketHandler();
        $planetHandler = $this->getModel()->getPlanetHandler();
        $packets = $packetHandler->getAllPackets();
        foreach ($packets as $packet) {
            $packet->setDestinationPlanet($planetHandler->searchPlanetByCod($packet->getDestinationPlanetId())[0]);
            $packet->setAvailableSeats($packetHandler->getAvailableSeats($packet));
        }

        $data["data"]["packets"] = $packets;
        //Set the title
        $data["header"]["title"] = "Elenco Viaggi";
        //Set custom js
        $data["header"]["js"] = [];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new GenericView("packetlist");
        //Render the view
        $view->render($data); 
    }

}