<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class InsertTrackInfoController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        $orderHandler = $this->getModel()->getOrderHandler();
        $ordersHandler = $this->getModel()->getOrdersHandler();
        $trackInfoHandler = $this->getModel()->getTrackInfoHandler();

        if(isset($_POST["delivery"])) {
            //Deliver packet to user address (delivered)
            $codOrder = $_POST["codOrder"];
            $description = $_POST["description"];
            $trackInfoBuilder = new TrackInfoBuilder();
            
            $order = new Order($codOrder);

            //Get Deliver City
            $city = $orderHandler->getDeliverCityOfOrder($order);
            $trackInfo = $trackInfoBuilder->createFromAssoc(array("CodOrder"=>$codOrder, "City"=>$city, "Description"=>$description, "DateTime"=>date("Y-m-d H:i:s")));

            //Add TrackInfo
            if($trackInfoHandler->addTrackInfo($trackInfo)) {
                //Set OrderState "consegnato"
                if($orderHandler->setOrderState($order, new OrderState(4,"Spedito"))) {
                    $data["data"]["text"] = "Aggiornato correttamente";
                } else {
                    $data["data"]["text"] = "Errore nell'aggiornamento";
                }
            } else {
                $data["data"]["text"] = "Errore nell'aggiornamento";
            }


        } else if(isset($_POST["add"])) {
            //Add Track Info (in progress)
            $codOrder = $_POST["codOrder"];
            $city = $_POST["city"];
            $description = $_POST["description"];
            $trackInfoBuilder = new TrackInfoBuilder();
            $trackInfo = $trackInfoBuilder->createFromAssoc(array("CodOrder"=>$codOrder, "City"=>$city, "Description"=>$description, "DateTime"=>date("Y-m-d H:i:s")));

            //Add TrackInfo
            if($trackInfoHandler->addTrackInfo($trackInfo)) {
                //Set OrderState "in consegna"
                if($orderHandler->setOrderState($order, new OrderState(3,"In Consegna"))) {
                    $data["data"]["text"] = "Aggiornato correttamente";
                } else {
                    $data["data"]["text"] = "Errore nell'aggiornamento";
                }
            } else {
                $data["data"]["text"] = "Errore nell'aggiornamento";
            }
            
        }

        $orders = $ordersHandler->getInProgressOrders();

        $data["data"]["orders"] = $orders;
        //Set the title
        $data["header"]["title"] = "Aggiungi info di tracking";
        //Set custom js
        $data["header"]["js"] = [];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new GenericView("inserttrackinfo");
        //Render the view
        $view->render($data);     
    }

}