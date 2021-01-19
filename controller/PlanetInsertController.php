<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PlanetInsertController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $planetHandler = $this->getModel()->getPlanetHandler();
        if(isset($_POST["inputName"])) {
            $data["Name"] = $_POST["inputName"];
            /* $data["imgPlanet"] = $_POST["inputImage"]; */
            $data["Temperature"] = $_POST["inputTemperature"];
            $data["SunDistance"] = $_POST["inputSunDistance"];
            $data["Mass"] = $_POST["inputMass"];
            $data["Surface"] = $_POST["inputSurface"];
            $data["Composition"] = $_POST["inputComposition"];
            $data["DayLength"] = $_POST["inputDay"];
            $data["Description"] = $_POST["inputDescription"];
            $data["Visible"] = isset($_POST["inputVisible"]);

            $builder = new PlanetBuilder();
            $planet = $builder->createFromAssoc($data);
            
            $result = $planetHandler->insertPlanet($planet);
            
            if($result == true) {
                echo("Destinazione inserita correttamente.");
            } else {
                $data["data"]["error"] = "Errore di inserimento.";
                $data["header"]["title"] = "Nuova destinazione";
                $data["header"]["js"] = [];
                $data["header"]["css"] = [];
                $view = new GenericView("planetinsert");
                $view->render($data); 
            }
        } else {
            $data["data"] = [];
            $data["header"]["title"] = "Nuova destinazione";
            $data["header"]["js"] = [];
            $data["header"]["css"] = [];
            $view = new GenericView("planetinsert");
            $view->render($data); 
        }
    }
}
?>