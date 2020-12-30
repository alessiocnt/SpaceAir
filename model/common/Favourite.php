<?php

class Favourite {

    private User $user;
    private Planet $planet;
    private DateTime $date;

    public function __construct(User $user, Planet $planet, DateTime $date) {
        $this->user = $user;
        $this->planet = $planet;
        $this->date = $date;
    }

    public function getUser() : User {
        return $this->user;
    }

    public function getPlanet() : Planet {
        return $this->planet;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

}

?>