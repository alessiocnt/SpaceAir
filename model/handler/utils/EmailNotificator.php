<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class EmailNotificator implements NotificationSender {

    public function __construct() {
    }

    //users is an array of user
    public function send(TemplateNotification $notification, $users) {

    }
}

?>