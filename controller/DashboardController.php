<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class DashboardController extends AdminLoggedController {
    
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
            $adminInfoHandler = $this->getModel()->getAdminInfoHandler();
            $data["data"] = [];
            //Set the title
            $data["header"]["title"] = "Dashboard";
            //Set custom js
            $data["header"]["js"] = ["https://canvasjs.com/assets/script/canvasjs.min.js", "/spaceair/view/js/dashboard.js"];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("dashboardhome");
            //Render the view
            $view->render($data); 
        }
    }

}