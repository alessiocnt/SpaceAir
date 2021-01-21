<?php

/*
    Class that represent a planet.
*/
class Planet {
    private int $codPlanet;
    private string $name;
    private int $temperature;
    private float $mass;
    private float $surface;
    private float $sunDistance;
    private string $composition;
    private int $dayLength;
    private $imgPlanet;
    private string $description;
    private bool $visible;
    private $packets = array(); //Array to store packets
    private $reviews = array(); //Array to store reviews of this planet

    /* Base construct */
    public function __construct(int $codPlanet, string $name = "", int $temperature = 0, float $mass = 0, float $surface = 0, float $sunDistance = 0, string $composition = "", int $dayLength = 0, $imgPlanet = "", string $description = "", bool $visible = true) {
        $this->codPlanet = $codPlanet;
        $this->name = $name;
        $this->temperature = $temperature;
        $this->mass = $mass;
        $this->surface = $surface;
        $this->sunDistance = $sunDistance;
        $this->composition = $composition;
        $this->dayLength = $dayLength;
        $this->imgPlanet = $imgPlanet;
        $this->description = $description;
        $this->visible = $visible;
    }

    /* Getters */
    public function getCodPlanet() : int {
        return $this->codPlanet;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getTemperature() : int {
        return $this->temperature;
    }

    public function getMass() : float {
        return $this->mass;
    }

    public function getSurface() : float {
        return $this->surface;
    }

    public function getSunDistance() : float {
        return $this->sunDistance;
    }

    public function getComposition() : string {
        return $this->composition;
    }

    public function getDayLength() : int {
        return $this->dayLength;
    }

    public function getImgPlanet() {
        return $this->imgPlanet;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function isVisible() : bool {
        return $this->visible;
    }
    
    /* External relationships */
    public function setPackets($packets) {
        $this->packages = $packets;
    }

    public function getPackets() {
        return $this->packets;
    }

    public function setReviews($reviews) {
        $this->reviews = $reviews;
    }

    public function getReviews() {
        return $this->reviews;
    }

}


?>

