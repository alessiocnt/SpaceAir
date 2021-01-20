<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class DestinationsApi extends AbstractApi {
    private $planet;
    public function __construct() {
        parent::__construct();
    }

    public function execute() {
        $res;
        if(!isset($_SESSION["user_id"])) {
            $res = json_encode(array("msg"=>"Errore nell'aggiunta ai preferiti."));
        } else {
            $user = $_SESSION["user_id"];
            $stmt = $db->prepare("INSERT INTO INTEREST (Date, IdUser, CodPlanet) VALUES (?, ?, ?);");   
            $planetCode = $planet->getCodPlanet();
            $stmt->bind_param('sii', CURRENT_TIMESTAMP, $user, $planetCode);
            $stmt->execute();
            $res = json_encode(array("msg"=>"Aggiunta avvenuta con successo."));
        } 
        echo json_encode(array("msg"=>"aaaaaaaaaaaa"));
    }

    public function setPlanet($planetName) {
        $this->planet = searchPlanetByName($planetName);
    }

    private function searchPlanetByName($name) {
        $stmt = $db->prepare("SELECT * FROM planet WHERE Name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $builder = new PlanetBuilder();
        $planet = $builder->createFromAssoc($result[0]);
        return $planet;
    } 

} 


$dApi = new DestinationsApi(); 
$dApi->setPlanet($_POST["planet"]);

?>
