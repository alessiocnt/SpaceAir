<?php


interface NotificationSender {
    //Send a templateNotification to array of users
    public function send(TemplateNotification $notification, $users);
}

?>