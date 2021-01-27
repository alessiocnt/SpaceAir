<?php

class UserPacketDetailsController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(isset($_GET["idpacket"]) && isset($_GET["idorder"])) {
            //Get User data
            $userInfoHandler = $this->getModel()->getUserInfoHandler();
            $currentUser = $userInfoHandler->getUserInfo(new User(Utils::getUserId()));
            $ordersHandler = $this->getModel()->getOrdersHandler();

            $codOrder = $_GET["idorder"];
            $packetDetails = $ordersHandler->getPacketInOrderDetails(new Packet($_GET["idpacket"]), new Order($codOrder));
            
            $data["data"]["packet"] = $packetDetails;
            $data["data"]["user"] = $currentUser;
            $data["data"]["codOrder"] = $codOrder;
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