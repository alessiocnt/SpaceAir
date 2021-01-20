<?php 

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class NotificationBuilder implements Builder {

    private int $code;
    private DateTime $dateHour;
    private string $title;
    private string $description;
    private int $notificationType;
    private ?int $user;
    private $notificationSubject;
    private bool $seen;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        $this->notificationSubject = $this->calculateNotificationSubject($assoc);
        return new Notification($this->code, $this->dateHour, $this->title, $this->description, $this->notificationType, $this->user, $this->notificationSubject, $this->seen);
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

    public function setIdUser($idUser) {
        $this->user = $idUser;
    }

    public function setView($view) {
        $this->seen = $view;
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