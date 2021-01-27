<?php

require_once("./autoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER) && !$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKADMIN)) {
    die("ko");
}
$notificationHandler = $model->getNotificationDispatcher();

if(!isset($_POST["id"])) {
    die('Id non impostato impossibile accedere');
}

$user = new User(Utils::getUserId());
$notification = new TemplateNotification($_POST["id"]);
$res = $notificationHandler->seenNotification($user, $notification);
if(!$res) {
    die('Errore nella rimozione');
} else {
    echo 'ok';
}

?>