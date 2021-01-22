<?php

class Packet {
    private int $code;
    private $img;
    private ?DateTime $departureDateHour;
    private ?DateTime $arriveDateHour;
    private float $price;
    private int $maxSeats;
    private int $aviableSeats = 0;
    private string $description;
    private ?Planet $destinationPlanet;
    private bool $visible;

    public function __construct(int $code, $img, DateTime $departureDateHour = NULL, DateTime $arriveDateHour = NULL, float $price = 0, int $maxSeats = 0, string $description = "", Planet $destinationPlanet = NULL, bool $visible = false) {
        $this->code = $code;
        $this->img = $img;
        $this->departureDateHour = $departureDateHour;
        $this->arriveDateHour = $arriveDateHour;
        $this->price = $price;
        $this->maxSeats = $maxSeats;
        $this->description = $description;
        $this->destinationPlanet = $destinationPlanet;
        $this->visible = $visible;
    }

    public function getCode() : int {
        return $this->code;
    }

    public function getImg() {
        return $this->img;
    }

    public function getDepartureDateHour() : DateTime {
        return $this->departureDateHour;
    }

    public function getArriveDateHour() : DateTime {
        return $this->arriveDateHour;
    }

    public function getPrice() : float { 
        return $this->price;
    }

    public function getMaxSeats() : int {
        return $this->maxSeats;
    }

    public function getAviableSeats() : int {
        return $this->aviableSeats;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getDestinationPlanet() : Planet {
        return $this->destinationPlanet;
    }


    public function getDestinationPlanetId() {
        return $this->destinationPlanet->getCodPlanet();   
    }

    public function isVisible() : bool {
        return $this->visible;
    }

    public function setAviableSeats($aviableSeats) {
        $this->aviableSeats = $aviableSeats;
    }

    public function setDestinationPlanet(Planet $platet) {
        $this->destinationPlanet = $platet;
    }

}

?>