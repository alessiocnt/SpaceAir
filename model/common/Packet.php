<?php

class Packet {
    private int $code;
    private $img;
    private DateTime $departureDateHour;
    private DateTime $arriveDateHour;
    private float $price;
    private int $maxSeats;
    private int $aviableSeats;
    private string $description;
    private int $destinationPlanet;

    public function __construct(int $code, $img, DateTime $departureDateHour, DateTime $arriveDateHour, float $price, int $maxSeats, int $aviableSeats, string $description, int $destinationPlanet) {
        $this->code = $code;
        $this->img = $img;
        $this->departureDateHour = $departureDateHour;
        $this->arriveDateHour = $arriveDateHour;
        $this->price = $price;
        $this->maxSeats = $maxSeats;
        $this->aviableSeats = $aviableSeats;
        $this->description = $description;
        $this->destinationPlanet = $destinationPlanet;
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

    public function getDestinationPlanetId() : int {
        return $this->destinationPlanet;
    }
}

?>