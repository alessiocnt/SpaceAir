<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PassengerListController extends AdminLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(!isset($_GET["codPacket"])) {
            header("Location:packetlist.php");
        } else {
            echo $_GET["codPacket"];
            /*//Get User data
            $userInfoHandler = $this->getModel()->getUserInfoHandler();
            $currentUser = $userInfoHandler->getUserInfo(new User(Utils::getUserId()));
            $currentUser->setInterests($userInfoHandler->getUserInterest($currentUser));
            
            $data["data"]["user"] = $currentUser;
            //Set the title
            $data["header"]["title"] = "Profilo";
            //Set custom js
            $data["header"]["js"] = [];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("profile");
            //Render the view
            $view->render($data); */
        }
    }

}