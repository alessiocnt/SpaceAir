<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class MyAddressController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        //Get User data
        $userInfoHandler = $this->getModel()->getUserInfoHandler();
        $currentUser = new User(Utils::getUserId());

        $data["data"]["addresses"] = $userInfoHandler->getAddresses($currentUser);
        //Set the title
        $data["header"]["title"] = "I miei indirizzi";
        //Set custom js
        $data["header"]["js"] = ["/spaceair/view/js/myaddress.js"];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new GenericView("myaddress");
        //Render the view
        $view->render($data); 
    }

}