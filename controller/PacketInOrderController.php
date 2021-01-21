<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PacketInOrderController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(isset($_GET["id"])) {
            //Get User data
            $userInfoHandler = $this->getModel()->getUserInfoHandler();
            $ordersHandler = $this->getModel()->getOrdersHandler();

            $packets = $ordersHandler->getOrderDetail(new Order($_GET["id"]));
            
            $data["data"]["packets"] = $packets;
            //Set the title
            $data["header"]["title"] = "Dettaglio Ordine";
            //Set custom js
            $data["header"]["js"] = [];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("packetinorder");
            //Render the view
            $view->render($data); 

        } else {
            header("Location: myorders.php");
        }
    }

}