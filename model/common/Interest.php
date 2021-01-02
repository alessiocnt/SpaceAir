<?php

class Interest {
    private int $user;
    private int $planet;
    private DateTime $date;

    public function __construct(int $user, int $planet, DateTime $date) {
        $this->user = $user;
        $this->planet = $planet;
        $this->date = $date;
    }

    public function getUserId() : int {
        return $this->user;
    }

    public function getPlanetId() : int {
        return $this->planet;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

}

?>