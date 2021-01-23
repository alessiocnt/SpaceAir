<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class UserPacketDetailsController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(isset($_GET["idpacket"]) && isset($_GET["idorder"])) {
            //Get User data
            $userInfoHandler = $this->getModel()->getUserInfoHandler();
            $ordersHandler = $this->getModel()->getOrdersHandler();

            //$codOrder = $_GET["id"];
            //$packets = $ordersHandler->getOrderDetail(new Order($codOrder));
            
            $data["data"]["data"] = "";
            //Set the title
            $data["header"]["title"] = "Dettaglio pacchetto";
            //Set custom js
            $data["header"]["js"] = [];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("userpacketdetails");
            //Render the view
            $view->render($data); 

        } else {
            header("Location: myorders.php");
        }
    }

}