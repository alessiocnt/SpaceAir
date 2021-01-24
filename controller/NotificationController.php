<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class NotificationController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
        Utils::sec_session_start();
    }

    public function execute() {
        if(!$this->getModel()->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER) && !$this->getModel()->getUserHandler()->checkLogin(UserHandler::$LOGINOKADMIN)) {
            die(json_encode(array("msg" => "ko")));
        }
        $notificationHandler = $this->getModel()->getNotificationDispatcher();
        $data["data"]["notifications"] = $notificationHandler->getAllNotificationsOfUser(new User(Utils::getUserId()));
        $data["header"]["title"] = "Notifiche";
        $data["header"]["js"] = [];
        $data["header"]["css"] = [];
        $view = new GenericView("notification");
        $view->render($data); 
    }
}
