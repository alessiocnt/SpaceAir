<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class DestinationsController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);

        //Start secure session
        Utils::sec_session_start();
    }

    public function execute() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        if(isset($_POST["searchBar"]) && $_POST["searchBar"]!=null) {
            $planetName = $_POST["searchBar"];
            /* $builder = new PlanetBuilder();
            $planet = $builder->createFromAssoc($data); */
            
            $result = $planetHandler->searchPlanetByName($planetName);
            
            if($result == false) {
                $data["data"]["error"] = "Nessun pianeta trovato.";
                $data["header"]["title"] = "Destinazioni";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("destinations");
                $view->render($data);
            } else {
                $data["data"]["planets"] = $result;
                $data["header"]["title"] = "Destinazioni";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("destinations");
                $view->render($data); 
            }
        } else {
            $data["data"]["planets"] = $planetHandler->getPlanets();
            $data["header"]["title"] = "Destinazioni";
            $data["header"]["js"] = [];
            $data["header"]["css"] = [];
            $view = new GenericView("destinations");
            $view->render($data); 
        }
    }
}
?>