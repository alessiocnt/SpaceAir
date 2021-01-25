<?php 

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class TemplateNotificationBuilder implements Builder {

    private int $code = 0;
    private ?DateTime $dateHour = NULL;
    private string $title = "";
    private string $description = "";
    private int $notificationType = 0;
    private ?Planet $planet = NULL;
    private ?Packet $packet = NULL;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new TemplateNotification($this->code, $this->dateHour, $this->title, $this->description, $this->notificationType, $this->planet, $this->packet);
    }

    public function setCodNotification($code) {
        $this->code = $code;
    }

    public function setDateTime($dateTime) {
        $this->dateHour = DateTime::createFromFormat("Y-m-d H:i:s", $dateTime);
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setType($type) {
        $this->notificationType = $type;
    }

    public function setCodPlanet($codPlanet) {
        $this->planet = new Planet($codPlanet);
    }

    public function setCodPacket($codPacket) {
        $this->packet = new Packet($codPacket);
    }

}

?>