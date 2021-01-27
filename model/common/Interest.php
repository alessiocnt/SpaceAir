<?php

class Interest {
    private int $user;
    private $planet;
    private DateTime $date;

    public function __construct(int $user, $planet, DateTime $date) {
        $this->user = $user;
        $this->planet = $planet;
        $this->date = $date;
    }

    public function getUserId() : int {
        return $this->user;
    }

    public function getPlanet() {
        return $this->planet;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

    //Setters 
    public function setPlanet($planet) {
        $this->planet = $planet;
    }

}

?>