<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class DestinationsAdminController extends AdminLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
        /* Utils::sec_session_start(); */
    }
    public function executePage() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        if(isset($_POST["searchBar"]) && $_POST["searchBar"]!=null) {
            $planetName = $_POST["searchBar"];
            $result = $planetHandler->searchPlanetByName($planetName);
            if($result == false) {
                $data["data"]["error"] = "Nessun pianeta trovato.";
                $data["header"]["title"] = "Elenco destinazioni";
                $data["header"]["js"] = ["/spaceair/view/js/editDestination.js", "/spaceair/view/js/deleteDestination.js"];
                $data["header"]["css"] = [];
                $view = new GenericView("destinationsadmin");
                $view->render($data);
            } else {
                $data["data"]["planets"] = $result;
                $data["header"]["title"] = "Elenco destinazioni";
                $data["header"]["js"] = ["/spaceair/view/js/editDestination.js", "/spaceair/view/js/deleteDestination.js"];
                $data["header"]["css"] = [];
                $view = new GenericView("destinationsadmin");
                $view->render($data); 
            }
        } else {
            $data["data"]["planets"] = $planetHandler->getAllPlanets();
            $data["header"]["title"] = "Elenco destinazioni";
            $data["header"]["js"] = ["/spaceair/view/js/editDestination.js", "/spaceair/view/js/deleteDestination.js"];
            $data["header"]["css"] = [];
            $view = new GenericView("destinationsadmin");
            $view->render($data); 
        }
    }
}
?>