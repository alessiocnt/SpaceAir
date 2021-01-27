<?php
/*
    Class that represent a review
*/
class Review {
    private $dateTime;
    private string $title = "";
    private string $description;
    private int $rating;
    private int $idUser;
    private int $codPlanet;

    /* Base construct */
    public function __construct($dateTime, $title, $description, $rating, $idUser, $codPlanet) {
        $this->dateTime = $dateTime;
        $this->title = $title;
        $this->description = $description;
        $this->rating = $rating;
        $this->idUser = $idUser;
        $this->codPlanet = $codPlanet;
    }

    /* Getters */
    public function getDateTime() {
        return $this->dateTime;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getCodPlanet() : int {
        return $this->codPlanet;
    }
}
?>

