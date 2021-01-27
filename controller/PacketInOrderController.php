<?php

class PacketInOrderController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(isset($_GET["id"])) {
            //Get User data
            $userInfoHandler = $this->getModel()->getUserInfoHandler();
            $ordersHandler = $this->getModel()->getOrdersHandler();

            $codOrder = $_GET["id"];
            $packets = $ordersHandler->getOrderDetail(new Order($codOrder));
            
            $data["data"]["packets"] = $packets;
            $data["data"]["codOrder"] = $codOrder;
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