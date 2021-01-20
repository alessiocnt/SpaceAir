<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class TestController extends AbstractController {

    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {

        $this->getModel()->getNotificationDispatcher()->createGeneral("Titolo","Ciao belli", array(new User(1), new User(28)));
        //$this->getModel()->getNotificationDispatcher()->createPacketRelated("Titolo","Ciao belli",new Packet(1) , array(new User(1), new User(28)));
        //$this->getModel()->getNotificationDispatcher()->createPlanetRelated("Titolo","Ciao belli",new Planet(1) , array(new User(1), new User(28)));




        //Get Data from model
        $name = $this->getModel()->getTestHandler()->getName();
        //Transform in data for the view
        $data["data"]["name"] = $name;
        //Set the title
        $data["header"]["title"] = "Test";
        //Set custom js
        $data["header"]["js"] = ["https://canvasjs.com/assets/script/canvasjs.min.js", "/spaceair/view/js/dashboard.js"];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new TestView();
        //Render the view
        $view->render($data);

    }
}
?>