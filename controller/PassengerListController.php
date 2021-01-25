<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PassengerListController extends AdminLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(!isset($_GET["codPacket"])) {
            header("Location:packetlist.php");
        } else {
            $packet = new Packet($_GET["codPacket"]);

            $adminInfoHandler = $this->getModel()->getAdminInfoHandler();
            $passengers = $adminInfoHandler->getActualPassenger($packet);

            $data["data"]["passengers"] = $passengers;
            //Set the title
            $data["header"]["title"] = "Elenco passeggeri";
            //Set custom js
            $data["header"]["js"] = [];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("passengerlist");
            //Render the view
            $view->render($data);
        }
    }

}