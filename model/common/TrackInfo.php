<?php


//Class that represent a track info

class TrackInfo {
    private Order $order;
    private DateTime $date;
    private string $city;
    private string $description;

    public function __construct(Order $order, DateTime $date, string $city = "", string $description) {
        $this->order = $order;
        $this->date = $date;
        $this->city = $city;
        $this->description = $description;
    }

    public function getOrder() : Order {
        return $this->order;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

    public function getCity() : string {
        return $this->city;
    }

    public function getDescription() : string {
        return $this->description;
    }

}

?>