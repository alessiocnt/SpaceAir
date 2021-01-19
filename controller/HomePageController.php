<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class HomePageController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);

        //Start secure session
        Utils::sec_session_start();
    }

    public function execute() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        //Recupera i dati dei pianeti
        echo("AAAAAAAAAAAAAAA");
var_dump($planetHandler->getPlanets());
        $data["data"]["planets"] = $planetHandler->getPlanets();
        
        $data["header"]["title"] = "SpaceAir - Home";
        $data["header"]["js"] = [];
        $data["header"]["css"] = [];
        $view = new GenericView("homepage");
        $view->render($data); 
    }
}
?>