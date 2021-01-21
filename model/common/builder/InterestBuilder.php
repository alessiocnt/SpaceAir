<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class InterestBuilder implements Builder {
    private int $user;
    private int $planet;
    private DateTime $date;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new Interest($this->user, $this->planet, $this->date);
    }

    public function setDate($dateTime) {
        $this->date = DateTime::createFromFormat("Y-m-d H:i:s", $dateTime);
    }

    public function setIdUser($idUser) {
        $this->user = $idUser;
    }

    public function setCodPlanet($codPlanet) {
        $this->planet = $codPlanet;
    }
}


?>