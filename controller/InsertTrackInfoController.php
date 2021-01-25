<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class InsertTrackInfoController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        $orderHandler = $this->getModel()->getOrdersHandler();

        if(isset($_POST["delivery"])) {
            //Deliver packet to user address (delivered)
            $codOrder = $_POST["codOrder"];
            $descrizione = $_POST["description"];

            echo $codOrder . $descrizione;

        } else if(isset($_POST["add"])) {
            //Add Track Info (in progress)
            $codOrder = $_POST["codOrder"];
            $city = $_POST["city"];
            $descrizione = $_POST["description"];

            echo $codOrder . $city .$descrizione;
        } else {
            $orders = $orderHandler->getInProgressOrders();

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

}