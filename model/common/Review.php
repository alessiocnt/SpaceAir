<?php
/*
    Class that represent a review
*/
class Review {
    private DateTime $dateTime;
    private string $title;
    private string $description;
    private int $rating;
    private int $idUser;
    private int $codPlanet;

    /* Base construct */
    public function __construct(DateTime $dateTime, string $title, string $description, int $rating, int $idUser, int $codPlanet) {
        $this->date = $dateTime;
        $this->title = $title;
        $this->description = $description;
        $this->stars = $rating;
        $this->idUser = $idUser;
        $this->idPlanet = $codPlanet;
    }

    /* Getters */
    public function getDateTime() : DateTime {
        return $this->dateTime;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getRating() : int {
        return $this->rating;
    }

    public function getIdUser() : int {
        return $this->idUser;
    }

    public function getCodPlanet() : int {
        return $this->codPlanet;
    }
}
?>

