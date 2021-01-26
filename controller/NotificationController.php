<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class NotificationController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        if(!$this->getModel()->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER) && !$this->getModel()->getUserHandler()->checkLogin(UserHandler::$LOGINOKADMIN)) {
            header("location: /spaceair/login.php");
        }
        $notificationHandler = $this->getModel()->getNotificationDispatcher();
        $user = new User(Utils::getUserId());
        $notifications = $notificationHandler->getAllNotificationsOfUser($user);
        foreach ($notifications as $notification) {
            $notificationHandler->seenNotification($user, $notification);
        }
        $data["data"]["notifications"] = $notifications;
        $data["header"]["title"] = "Notifiche";
        $data["header"]["js"] = [];
        $data["header"]["css"] = [];
        $view = new GenericView("notification");
        $view->render($data); 
    }
}
