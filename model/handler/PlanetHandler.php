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
        if($planet->getImgPlanet() != "") {
            list($uploadResult, $imageName) = Utils::uploadImage($_SERVER["DOCUMENT_ROOT"] . "/spaceair/res/upload/admin/", $planet->getImgPlanet());
            if($uploadResult != Utils::$IMGUPLOADOK) {
               return $uploadResult;
            }
        }

        $insert_stmt = $db->prepare("INSERT INTO PLANET (Name, Temperature, Mass, Surface, SunDistance, Composition, DayLength, Img, Description, Visible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");   
        $visible = $planet->isVisible() ? 1 : 0;
        $name = $planet->getName();
        $temperature = $planet->getTemperature();
        $mass = $planet->getMass();
        $surface = $planet->getSurface();
        $sunDistance = $planet->getSunDistance();
        $composition = $planet->getComposition();
        $dayLength = $planet->getDayLength();
        $img = $imageName;
        $description = $planet->getDescription();

        if (!$insert_stmt->bind_param('sidddsissi', $name, $temperature, $mass, $surface, $sunDistance, $composition, $dayLength, $img, $description, $visible)) {
            echo "Binding parameters failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
            return false;
        }
        if (!$insert_stmt->execute()) {
            echo "Execute failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
            //"Solido", "Liquido", "Gassoso", "Lava"
            return false;
        }
        return true;
    }

    public function updatePlanet($planet, $oldPlanet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();

        if($planet->getImgPlanet() != "") {
            list($uploadResult, $imageName) = Utils::uploadImage($_SERVER["DOCUMENT_ROOT"] . "/spaceair/res/upload/admin/", $planet->getImgPlanet());
            if($uploadResult != Utils::$IMGUPLOADOK) {
               return $uploadResult;
            }
        }
        $stmt = $db->prepare("UPDATE PLANET SET Name = ?, Temperature = ?, Mass = ?, Surface = ?, SunDistance = ?, Composition = ?, DayLength = ?, Img = ?, Description = ?, Visible = ? WHERE CodPlanet = ?");   
        $visible = $planet->isVisible() ? 1 : 0;
        $name = $planet->getName();
        $temperature = $planet->getTemperature();
        $mass = $planet->getMass();
        $surface = $planet->getSurface();
        $sunDistance = $planet->getSunDistance();
        $composition = $planet->getComposition();
        $dayLength = $planet->getDayLength();
        $img = $imageName;
        $description = $planet->getDescription();
        if (!$stmt->bind_param('sidddsissii', $name, $temperature, $mass, $surface, $sunDistance, $composition, $dayLength, $img, $description, $visible, $oldPlanet)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        } 
        return true;
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

    public function searchPlanetByName($name) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM planet WHERE Name = ?");
        if (!$stmt->bind_param('s', $name)) {
            //echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
        if (!$stmt->execute()) {
            //echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } else {
            $builder = new PlanetBuilder();
            $planet = $builder->createFromAssoc($result[0]);
            return array($planet);
        }
    }

    public function searchPlanetByCod($cod) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM planet WHERE CodPlanet = ?");
        if (!$stmt->bind_param('s', $cod)) {
            //echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
        if (!$stmt->execute()) {
            //echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } else {
            $builder = new PlanetBuilder();
            $planet = $builder->createFromAssoc($result[0]);
            return array($planet);
        }
    }

    public function addFavourite($userId, $planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("INSERT INTO INTEREST (Date, IdUser, CodPlanet, Visible) VALUES (?, ?, ?, 1);");   
        $planetCode = $planet->getCodPlanet();
        $time = date('Y-m-d H:i:s');
        if (!$stmt->bind_param('sii', $time, $userId, $planetCode)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        return true;
    }

    public function updateFavourite($userId, $planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE INTEREST SET Visible = 1 WHERE IdUser = ? AND CodPlanet = ?");   
        $planetCode = $planet->getCodPlanet();
        if (!$stmt->bind_param('ii', $userId, $planetCode)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        return true;
    }

    public function findFavourite($userId, $planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT CodPlanet FROM INTEREST WHERE IdUser = ? AND CodPlanet = ?");
        $planetCode = $planet->getCodPlanet();
        if (!$stmt->bind_param('ii', $userId, $planetCode)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } else {
            return $result[0];
        }
    }

    public function hidePlanet($planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $planetId = $planet->getCodPlanet();
        $visible = 0;
        $stmt = $db->prepare("UPDATE PLANET SET Visible = ? WHERE CodPlanet = ?");   
        if (!$stmt->bind_param('ii', $visible, $planetId)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        return true;
    }

}

?>