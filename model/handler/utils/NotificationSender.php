<?php

interface NotificationSender {
    public function send($notification, $user);
}

?>