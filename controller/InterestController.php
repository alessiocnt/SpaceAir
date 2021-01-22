<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class InterestController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $userHandler = $this->getModel()->getUserHandler();
        $data["header"]["title"] = "Preferiti";
        $data["header"]["js"] = ["/spaceair/view/js/interest.js"];
        $data["header"]["css"] = [];
        $userInfoHandler = $this->getModel()->getUserInfoHandler();
        $data["data"]["interests"] = $userInfoHandler->getUserInterest($userHandler->getUserById(Utils::getUserId()));
        $view = new GenericView("interest");
        $view->render($data);
    }
}
?>