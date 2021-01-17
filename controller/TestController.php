<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/AbstractController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/test/TestView.php";

class TestController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        //Get Data from model
        $name = $this->getModel()->getTestHandler()->getName();
        //Transform in data for the view
        $data["data"]["name"] = $name;
        //Set the title
        $data["header"]["title"] = "Test";
        //Set custom js
        $data["header"]["js"] = ["https://canvasjs.com/assets/script/canvasjs.min.js", "/spaceair/view/js/dashboard.js"];
        //Create the view
        $view = new TestView();
        //Render the view
        $view->render($data);
    }
}
?>