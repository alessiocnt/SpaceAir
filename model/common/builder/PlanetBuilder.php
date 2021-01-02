<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PlanetBuilder implements Builder{
    private int $codPlanet;
    private string $name = "";
    private int $temperature;
    private float $mass;
    private float $surface;
    private float $sunDistance;
    private string $composition = "";
    private int $dayLength;
    private string $imgPlanet = "";
    private string $description = "";
    private bool $visible = true;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new Planet($this->codPlanet, $this->name, $this->temperature, $this->mass, $this->surface, $this->sunDistance, $this->composition, $this->dayLength, $this->imgPlanet, $this->description, $this->visible);
    }

    public function setCodPlanet(int $codPlanet) {
        $this->codPlanet = $codPlanet;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setTemperature(int $temperature) {
        $this->temperature = $temperature;
    }

    public function setMass(float $mass) {
        $this->mass = $mass;
    }

    public function setSurface(float $surface) {
        $this->surface = $surface;
    }

    public function setSunDistance(float $sunDistance) {
        $this->sunDistance = $sunDistance;
    }

    public function setComposition(string $composition) {
        $this->composition = $composition;
    }

    public function setDayLength(int $dayLength) {
        $this->dayLength = $dayLength;
    }

    public function setImg(string $imgPlanet) {
        $this->imgPlanet = $imgPlanet;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setVisibile(bool $visible) {
        $this->visible = $visible;
    }
}

?>