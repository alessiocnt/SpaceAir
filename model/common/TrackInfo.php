<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

//Class that represent a track info

class TrackInfo {
    private Order $order;
    private DateTime $date;
    private string $citta;
    private string $description;

    public function __construct(Order $order, DateTime $date, string $citta, string $description) {
        $this->order = $order;
        $this->date = $date;
        $this->citta = $citta;
        $this->description = $description;
    }

    public function getOrder() : Order {
        return $this->order;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

    public function getCitta() : string {
        return $this->citta;
    }

    public function getDescription() : string {
        return $this->description;
    }

}

?>