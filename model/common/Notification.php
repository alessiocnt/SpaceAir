<?php

/**
 * Class that models a notification
 */
class Notification {
    private int $code;
    private DateTime $dateHour;
    private string $title;
    private string $description;
    private NotificationType $notificationType;
    private User $user;
    private $notificationSubject;


    public function __construct() { }

    public static function create() {
        return new self();
    }

    public function setCode(int $code) {
        $this->code = $code;
        return $this;
    }

    public function setDateHour(DateTime $dateHour) {
        $this->dateHour = $dateHour;
        return $this;
    }

    public function setTitle(string $title) {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description) {
        $this->description = $description;
        return $this;
    }

    public function setNotificationType(NotificationType $notificationType) {
        $this->notificationType = $notificationType;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function setNotificationSubject($notificationSubject) {
        $this->notificationSubject = $notificationSubject;
        return $this;
    }

    public function setFromAssociativeArray($associativeArray) {
        $this->code = $associativeArray["Cod_notifica"];
        $this->dateHour = DateTime::createFromFormat("Y-m-d H:i:s", $associativeArray["Data_ora"]);
        $this->title = $associativeArray["Titolo"];
        $this->description = $associativeArray["Descrizione"];
        $this->notificationType = NotificationType::fromNumber($associativeArray["Tipo_notifica"]);
        $this->notificationSubject = $this->calculateNotificationSubject($associativeArray);
    }

    private function calculateNotificationSubject($associativeArray) {
        switch ($this->notificationType) {
            case NotificationType::GENERAL:
                return $associativeArray["Cod_pianeta"];

            case NotificationType::INTEREST:
                return $associativeArray["Cod_pacchetto"];

            case NotificationType::FLIGHT:
                return $associativeArray["Cod_ordine"];

            case NotificationType::PACKAGE:
                return $associativeArray["Cod_pacchetto_ordinato"];
        }
    }
}

?>