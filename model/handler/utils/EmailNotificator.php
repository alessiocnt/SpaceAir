<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class EmailNotificator implements NotificationSender {

    public function __construct() {
    }

    //users is an array of user
    public function send(TemplateNotification $notification, $users) {
        // foreach($users as $user) {
        //     mail($user->getMail(), $notification->getTitle(), $notification->getDescription());
        // }
    }
}

?>