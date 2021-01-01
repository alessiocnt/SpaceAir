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
        $data["name"] = $name;
        //Create the view
        $view = new TestView();
        //Render the view
        $view->render($data);
    }
}
?>