<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class ReviewBuilder implements Builder{
    private DateTime $dateTime;
    private string $title = "";
    private string $description = "";
    private int $rating;
    private int $idUser;
    private int $codPlanet;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new Review($this->dateTime, $this->title, $this->description, $this->rating, $this->idUser, $this->codPlanet);
    }

    public function setDateTime(DateTime $dateTime) {
        $this->dateTime = DateTime::createFromFormat("Y-m-d H:i:s", $dateTime);
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setRating(int $rating) {
        $this->rating = $rating;
    }

    public function setIdUser(int $idUser) {
        $this->idUser = $idUser;
    }

    public function setCodPlanet(int $codPlanet) {
        $this->codPlanet = $codPlanet;
    }

}

?>