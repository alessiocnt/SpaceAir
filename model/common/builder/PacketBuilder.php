<?php 



class PacketBuilder implements Builder {

    private int $code = 0;
    private string $img = "";
    private DateTime $departureDateHour;
    private DateTime $arriveDateHour;
    private float $price = 0;
    private int $maxSeats = 0;
    private int $AvailableSeats = 0;
    private string $description = "";
    private ?Planet $destinationPlanet = NULL;
    private bool $visible = false;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new Packet($this->code, $this->img, $this->departureDateHour, $this->arriveDateHour, $this->price, $this->maxSeats, $this->description, $this->destinationPlanet, $this->visible);
    }

    public function setCodPacket($codPacket) {
        $this->code = $codPacket;
    }

    public function setImg($imgBrochure) {
        $this->img = $imgBrochure;
    }

    public function setDateTimeDeparture($dateTimeDeparture) {
        $this->departureDateHour = DateTime::createFromFormat("Y-m-d H:i:s", $dateTimeDeparture);
    }

    public function setDateTimeArrival($dateTimeArrival) {
        $this->arriveDateHour = DateTime::createFromFormat("Y-m-d H:i:s", $dateTimeArrival);
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setMaxSeats($maxSeats) {
        $this->maxSeats = $maxSeats;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setCodPlanet($codPlanet) {
        $this->destinationPlanet = new Planet($codPlanet);
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }

}

?>