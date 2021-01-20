<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class DestinationsApi extends AbstractApi {
    private $planet;
    public function __construct() {
        parent::__construct();
    }

    public function execute() {
        if(!isset($_SESSION["user_id"])) {
            $res = json_encode(array("msg"=>"Errore nell'aggiunta ai preferiti."));
        } else {
            $user = $_SESSION["user_id"];
            $stmt = $this->getDb()->prepare("INSERT INTO INTEREST (Date, IdUser, CodPlanet) VALUES (?, ?, ?);");   
            $planetCode = $this->planet->getCodPlanet();
            $time = date('Y-m-d H:i:s');
            $stmt->bind_param('sii', $time, $user, $planetCode);
            $stmt->execute();
            $res = json_encode(array("msg"=>"Aggiunta avvenuta con successo."));
        } 
        echo($res);
    }

    public function setPlanet($planetName) {
        $this->searchPlanetByName($planetName);
        
    }

    private function searchPlanetByName($name) {
        $stmt = $this->getDb()->prepare("SELECT * FROM planet WHERE Name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $builder = new PlanetBuilder();
        $this->planet = $builder->createFromAssoc($result[0]);
    } 

} 

$dApi = new DestinationsApi(); 
$dApi->setPlanet($_POST["planet"]);
$dApi->execute();


?>
