<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER) && !$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKADMIN)) {
    die("ko");
}
$model = new ModelImpl();
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