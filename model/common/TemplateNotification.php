<?php

/**
 * Class that models a notification
 */
class TemplateNotification {
    private int $code;
    private ?DateTime $dateHour;
    private string $title;
    private string $description;
    private int $notificationType;
    private ?Planet $planet;
    private ?Packet $packet;


    public function __construct(int $code, $dateHour = NULL, string $title = "", string $description = "", int $notificationType = 0, Planet $planet = NULL, Packet $packet = NULL) {
        $this->code = $code;
        $this->dateHour = $dateHour;
        $this->title = $title;
        $this->description = $description;
        $this->notificationType = $notificationType;
        $this->planet = $planet;
        $this->packet = $packet;
    }

    public function getCode() : int {
        return $this->code;
    }

    public function getDateHour() : DateTime {
        return $this->dateHour;
    }

    public function getTitle() : string {
        return $this->title;
    }
    
    public function getDescription() : string {
        return $this->description;
    }

    public function getNotificationType() : int {
        return $this->notificationType;
    }

    public function getPlanet() : Planet {
        return $this->planet;
    }

    public function getPacket() : Packet {
        return $this->packet;
    }


    //Only allow this setter

    public function setPlanet(Planet $planet) {
        $this->planet = $planet;
    }

    public function setPacket(Packet $packet) {
        $this->packet = $packet;
    }
}

?>