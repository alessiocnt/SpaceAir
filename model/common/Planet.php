<?php

/*
    Class that represent a planet destination.
*/
class Planet {
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

    /*
        Base construct
    */
    public function __construct($builder) {
        $this->id = $builder->getId();
        $this->name = $builder->getName();
        /*$this->temperature = $builder->getTemperature();
        $this->mass = $builder->getMass();
        $this->surface = $builder->getSurface();
        $this->sunDistance = $builder->getSunDistance();
        $this->composition = $builder->getComposition();
        $this->dayDuration = $builder->getDayDuration();
        $this->imgPlanet = $builder->getImgPlanet();
        $this->description = $builder->getDescription();
        $this->visible = $builder->isVisible();*/
    }

    /*
        Getters
    */
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

    /*
        External relationships
    
    public function setPackets($packets) {
        $this->packets = $packets;
    }

    public function getPackets() {
        return $this->packets;
    }

    public function setReviews($reviews) {
        $this->reviews = $reviews;
    }

    public function getReviews() {
        return $this->reviews;
    }*/
}

?>

