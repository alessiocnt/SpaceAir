<?php

class DestinationsController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        if(isset($_POST["searchBar"]) && $_POST["searchBar"]!=null) {
            $planetName = $_POST["searchBar"];         
            $result = $planetHandler->getPlanetsByPrefix($planetName);
            
            if($result == false) {
                $data["data"]["error"] = "Nessun pianeta trovato.";
                $data["header"]["title"] = "Destinazioni";
                $data["header"]["js"] = ["./view/js/destinations.js"];
                $data["header"]["css"] = [];
                $view = new GenericView("destinations");
                $view->render($data);
            } else {
                $data["data"]["planets"] = $result;
                $data["header"]["title"] = "Destinazioni";
                $data["header"]["js"] = ["./view/js/destinations.js"];
                $data["header"]["css"] = [];
                $view = new GenericView("destinations");
                $view->render($data); 
            }
        } else {
            $data["data"]["planets"] = $planetHandler->getPlanets();
            $data["header"]["title"] = "Destinazioni";
            $data["header"]["js"] = ["./view/js/destinations.js"];
            $data["header"]["css"] = [];
            $view = new GenericView("destinations");
            $view->render($data); 
        }
    }
}
?>