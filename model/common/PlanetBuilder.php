<?php

/*
    Class that represent a planet destination.
*/
class PlanetBuilder {
    private int $id;
    private string $name;
    private int $temperature;
    private float $mass;
    private float $surface;
    private float $sunDistance;
    private string $composition;
    private int $dayDuration;
    private string $imgPlanet;
    private string $description;
    private bool $visible;
    // private $packets = array(); //Array to store packets
    // private $reviews = array(); //Array to store reviews of this planet

    public function __construct() {}

    public function setId(int $id) : PlanetBuilder{
        $this->id = $id;
        return $this;
    }

    public function setName(string $name) : PlanetBuilder {
        $this->name = $name;
        return $this;
    }

    public function setTemperature(int $temperature) : PlanetBuilder {
        $this->temperature = $temperature;
        return $this;
    }

    public function setMass(float $mass) : PlanetBuilder {
        $this->mass = $mass;
        return $this;
    }

    public function setSurface(float $surface) : PlanetBuilder {
        $this->surface = $surface;
        return $this;
    }

    public function setSunDistance(float $sunDistance) : PlanetBuilder {
        $this->sunDistance = $sunDistance;
        return $this;
    }

    public function setComposition(string $composition) : PlanetBuilder {
        $this->composition = $composition;
        return $this;
    }

    public function setDayDuration(int $dayDuration) : PlanetBuilder {
        $this->dayDuration = $dayDuration;
        return $this;
    }

    public function setImgPlanet(string $imgPlanet) : PlanetBuilder {
        $this->imgPlanet = $imgPlanet;
        return $this;
    }

    public function setDescription(string $description) : PlanetBuilder {
        $this->description = $description;
        return $this;
    }

    public function setVisibility(bool $visible) : PlanetBuilder {
        $this->visible = $visible;
        return $this;
    }

    public function build() : Planet {
        return new Planet($this);
    }

    /* Getter */
    public function getId() : int {
        return $this->id;
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

    public function getDayDuration() : int {
        return $this->dayDuration;
    }

    public function getImgPlanet() : string {
        return $this->imgPlanet;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function isVisible() : bool {
        return $this->visible;
    }
}


?>

