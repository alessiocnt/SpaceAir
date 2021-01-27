<?php

class PacketModifyController extends AdminLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $packetHandler = $this->getModel()->getPacketHandler();
        $planetHandler = $this->getModel()->getPlanetHandler();
        if(isset($_GET["Packet"])) {
            if($packet = $packetHandler->getAllPacketsById($_GET["Packet"])) {
                $packet->setDestinationPlanet($planetHandler->searchPlanetByCod($packet->getDestinationPlanetId())[0]);
                $data["data"]["packet"] = $packet;
                $data["data"]["planets"] = $planetHandler->getPlanets();
                $data["header"]["title"] = "Modifica pacchetto";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("packetmodify");
                $view->render($data); 
            } else {
                $data["data"] = [];
                $data["data"]["error"] = "Pacchetto non trovato";
                $data["header"]["title"] = "Modifica pacchetto";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("packetmodify");
                $view->render($data);
            }
        } else if(isset($_POST["packetId"])) {

            $packetHandler = $this->getModel()->getPacketHandler();

            $pack["CodPacket"] = $_POST["packetId"];
            $pack["CodPlanet"] = $_POST["inputDestination"];
            $pack["DateTimeDeparture"] = DateTime::createFromFormat("Y-m-j\TH:i", $_POST["inputDepartureDateHour"])->format('Y-m-d H:i:s');
            $pack["DateTimeArrival"] = DateTime::createFromFormat("Y-m-j\TH:i", $_POST["inputArriveDateHour"])->format('Y-m-d H:i:s');
            $pack["MaxSeats"] = $_POST["inputCapacity"];
            $pack["AvailableSeats"] = $pack["MaxSeats"];
            $pack["Price"] = $_POST["inputPrice"];
            $pack["Description"] = $_POST["inputDescription"];
            $pack["Visible"] = isset($_POST["inputVisible"]) ? 1 : 0;

            $builder = new PacketBuilder();
            $packet = $builder->createFromAssoc($pack);
            
            $result = $packetHandler->updatePacket($packet);

            if($result) {
                header("location:./packetlist.php");
            } else {
                $data["data"] = [];
                $data["data"]["error"] = "Pacchetto non modificato";
                $data["header"]["title"] = "Modifica pacchetto";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("packetmodify");
                $view->render($data);
            }
        }
    }

}