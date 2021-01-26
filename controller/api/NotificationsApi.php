<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER) && !$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKADMIN)) {
    die(json_encode(array("msg" => "ko")));
}
$notificationHandler = $model->getNotificationDispatcher();

$user = new User(Utils::getUserId());
$notifications = $notificationHandler->getNotificationsOfUser($user);
$res = array();
foreach ($notifications as $notification) {
    array_push($res, array("id"=>$notification->getCode(), "date"=>$notification->getDateHour()->format("d-m-Y H:i"), "title"=>$notification->getTitle()));
}
echo json_encode(array("msg"=>$res));

?>