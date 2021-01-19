<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class PlanetHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function insertPlanet($planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();

        $planetName = $planet->getName();
        //Check if the planet already exists
        $stmt = $db->prepare("SELECT Name FROM PLANET WHERE Name = ?");
        $stmt->bind_param("s",$planetName);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) > 0) {
            return false;
        }
        
        if ($insert_stmt = $db->prepare("INSERT INTO PLANET (Name, Temperature, Mass, Surface, SunDistance, Composition, DayLength, Img, Description, Visible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {    
            $visible = $planet->isVisible() ? 1 : 0;
            $name = $planet->getName();
            $temperature = $planet->getTemperature();
            $mass = $planet->getMass();
            $surface = $planet->getSurface();
            $sunDistance = $planet->getSunDistance();
            $composition = $planet->getComposition();
            $dayLength = $planet->getDayLength();
            $img = $planet->getImgPlanet();
            $description = $planet->getDescription();
            
            $insert_stmt->bind_param('sifffsissi', $name, $temperature, $mass, $surface, $sunDistance, $composition, $dayLength, $img, $description, $visible);
            $insert_stmt->execute();
            return true;
        }
        return false;
    }

    public function getPlanets() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM PLANET WHERE Visible = true");
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);

        $builder = new PlanetBuilder();
        $planets = array();
        foreach ($result as $planet) {
            array_push($planets,$builder->createFromAssoc($planet));
        }
        return $planets;
    }
}

?>