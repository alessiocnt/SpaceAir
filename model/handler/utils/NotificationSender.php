<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

interface NotificationSender {
    //Send a templateNotification to array of users
    public function send(TemplateNotification $notification, $users);
}

?>