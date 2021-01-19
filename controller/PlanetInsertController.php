<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PlanetInsertController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);

        //Start secure session
        Utils::sec_session_start();
    }

    public function execute() {
        $userHandler = $this->getModel()->getUserHandler();
        $planetHandler = $this->getModel()->getPlanetHandler();
        //Check if already logged
        if($userHandler->checkLogin()) {
            $data["data"]["error"] = "";
            $data["header"]["title"] = "Nuova destinazione";
            $data["header"]["js"] = [];
            $data["header"]["css"] = [];
            $view = new GenericView("planetinsert");
            $view->render($data);
        } else if(isset($_POST["inputName"])) {
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
            //Go to login page
            header("Location:login.php"); 
        }
    }
}
?>