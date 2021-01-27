<?php

class InsertTrackInfoController extends NoLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $orderHandler = $this->getModel()->getOrderHandler();
        $ordersHandler = $this->getModel()->getOrdersHandler();
        $trackInfoHandler = $this->getModel()->getTrackInfoHandler();
        $notificationDispatcher = $this->getModel()->getNotificationDispatcher();

        if(isset($_POST["delivery"])) {
            //Deliver packet to user address (delivered)
            $codOrder = $_POST["codOrder"];
            $description = $_POST["description"];
            $trackInfoBuilder = new TrackInfoBuilder();
            
            $order = new Order($codOrder);

            //Check not already delivered
            $prevorderState = $orderHandler->getOrderState($order);
            if($prevorderState->getCodState() != 4) {
                //Ok let's deliver this order
                //Get Deliver City
                $city = $orderHandler->getDeliverCityOfOrder($order);
                $trackInfo = $trackInfoBuilder->createFromAssoc(array("CodOrder"=>$codOrder, "City"=>$city, "Description"=>$description, "DateTime"=>date("Y-m-d H:i:s")));

                //Add TrackInfo
                if($trackInfoHandler->addTrackInfo($trackInfo)) {
                    //Set OrderState "consegnato"
                    if($orderHandler->setOrderState($order, new OrderState(4,"Spedito"))) {
                        $data["data"]["text"] = "Aggiornato correttamente";
                        //Notify
                        $orderInfo = $ordersHandler->getOrderDetail($order);
                        $notificationText = "Il tuo ordine contenente ";
                        foreach($orderInfo->getPackets() as $packet) {
                            $notificationText .= $packet->getPacket()->getDestinationPlanet()->getName() . " del " . $packet->getPacket()->getDepartureDateHour()->format("d/m/Y") . ", ";
                        }
                        $notificationText .= " è stato consegnato! Goditi il viaggio!";
                        $notificationDispatcher->createGeneral("Aggiornamento Tracking",$notificationText, array(new User($orderInfo->getUser()->getId())));
                    } else {
                        $data["data"]["text"] = "Errore nell'aggiornamento";
                    }
                } else {
                    $data["data"]["text"] = "Errore nell'aggiornamento";
                }
            } else {
                //Order already delivered, stop
                $data["data"]["text"] = "Ordine gi&agrave; consegnato";
            }
        } else if(isset($_POST["add"])) {
            //Add Track Info (in progress)
            $codOrder = $_POST["codOrder"];
            $city = $_POST["city"];
            $description = $_POST["description"];
            $trackInfoBuilder = new TrackInfoBuilder();

            $order = new Order($codOrder);
            //Check not already delivered
            $prevorderState = $orderHandler->getOrderState($order);
            if($prevorderState->getCodState() != 4) {
                $trackInfo = $trackInfoBuilder->createFromAssoc(array("CodOrder"=>$codOrder, "City"=>$city, "Description"=>$description, "DateTime"=>date("Y-m-d H:i:s")));
                //Add TrackInfo
                if($trackInfoHandler->addTrackInfo($trackInfo)) {
                    //Set OrderState "in consegna"
                    if($orderHandler->setOrderState($order, new OrderState(3,"In Consegna"))) {
                        $data["data"]["text"] = "Aggiornato correttamente";
                        if($prevorderState->getCodState() == 2) {
                            //If it's the first info notify user
                            $orderInfo = $ordersHandler->getOrderDetail($order);
                            $notificationText = "Il tuo ordine contenente ";
                            foreach($orderInfo->getPackets() as $packet) {
                                $notificationText .= $packet->getPacket()->getDestinationPlanet()->getName() . " del " . $packet->getPacket()->getDepartureDateHour()->format("d/m/Y") . ", ";
                            }
                            $notificationText .= " è partito!";
                            $notificationDispatcher->createGeneral("Aggiornamento Tracking",$notificationText, array(new User($orderInfo->getUser()->getId())));
                        }
                    } else {
                        $data["data"]["text"] = "Errore nell'aggiornamento";
                    }
                } else {
                    $data["data"]["text"] = "Errore nell'aggiornamento";
                }
            } else {
                //Order already delivered, stop
                $data["data"]["text"] = "Ordine gi&agrave; consegnato";
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