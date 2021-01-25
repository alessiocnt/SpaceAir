<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class InsertTrackInfoController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        $orderHandler = $this->getModel()->getOrdersHandler();
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