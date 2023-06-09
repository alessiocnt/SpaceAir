<?php

class ProfileController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(isset($_GET["logout"])) {
            //Start secure session
            Utils::sec_session_start();
            Utils::logout();
            header("Location:login.php");
        } else {
            //Get User data
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
            $view->render($data); 
        }
    }

}