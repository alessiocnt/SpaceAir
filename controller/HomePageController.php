<?php

class HomePageController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        //Recupera i dati dei pianeti
        $data["data"]["planets"] = $planetHandler->getPlanets();
        
        $data["header"]["title"] = "SpaceAir - Home";
        $data["header"]["js"] = ["./view/js/homepage.js"];
        $data["header"]["css"] = [];
        $view = new GenericView("homepage");
        $view->render($data); 
    }
}
?>