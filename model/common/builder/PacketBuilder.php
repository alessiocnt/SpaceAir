<?php 

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PacketBuilder implements Builder {

    private int $code;
    private $img;
    private DateTime $departureDateHour;
    private DateTime $arriveDateHour;
    private float $price;
    private int $maxSeats;
    private ?int $aviableSeats;
    private string $description;
    private int $destinationPlanet;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new Packet($this->code, $this->img, $this->departureDateHour, $this->arriveDateHour, $this->price, $this->maxSeats, $this->aviableSeats, $this->description, $this->destinationPlanet);
    }

    public function setCodPacket($codPacket) {
        $this->code = $codPacket;
    }

    public function setImgBrochure($imgBrochure) {
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
        $this->destinationPlanet = $codPlanet;
    }

    public function setAviableSeats($aviableSeats) {
        $this->aviableSeats = $aviableSeats;
    }

}

?>