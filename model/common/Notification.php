<?php

/**
 * Class that models a notification
 */
class Notification {
    private int $code;
    private DateTime $dateHour;
    private string $title;
    private string $description;
    private int $notificationType;
    private ?int $user;
    private $notificationSubject;
    private bool $seen;


    public function __construct(int $code, DateTime $dateHour, string $title, string $description, int $notificationType, int $user, $notificationSubject, bool $seen) {
        $this->code = $code;
        $this->dateHour = $dateHour;
        $this->title = $title;
        $this->description = $description;
        $this->notificationType = $notificationType;
        $this->user = $user;
        $this->notificationSubject = $notificationSubject;
        $this->seen = $seen;
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

    public function getNotificationType() : NotificationType {
        return $this->notificationType;
    }

    public function getUserId() : int {
        return $this->user;
    }

    public function getNotificationSubject() {
        return $this->notificationSubject;
    }

    public function isSeen() {
        return $this->seen;
    }
}

?>