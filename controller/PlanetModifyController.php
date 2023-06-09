<?php

class PlanetModifyController extends AdminLoggedController {
    
    private $oldPlanet;
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        if(isset($_GET["Destination"])) {
            $this->oldPlanet = $_GET["Destination"];
            if($planetHandler->searchPlanetByName($this->oldPlanet) != false) {
                $data["data"]["planets"] = $planetHandler->searchPlanetByName($this->oldPlanet)[0];
                $data["header"]["title"] = "Modifica destinazione";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("planetmodify");
                $view->render($data); 
            } else {
                $data["data"]["error"] = "Errore, destinazione non trovata.";
                $data["data"]["planets"] = $planetHandler->getAllPlanets();
                $data["header"]["title"] = "Destinazioni";
                $data["header"]["js"] = ["./view/js/destinations.js"];
                $data["header"]["css"] = [];
                $view = new GenericView("destinationsadmin");
                $view->render($data); 
            }
        }
    }
}
?>