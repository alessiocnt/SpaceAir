<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class TrackingInfoController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        if(!isset($_GET["id"])) {
            //If codOrder isn't set
            header("Location:myorders.php");
        } else {
            $trackInfoHandler = $this->getModel()->getTrackInfoHandler();
            $trackInfo = $trackInfoHandler->getTrackInfo(new Order($_GET["id"]));

            $data["data"]["trackInfo"] = $trackInfo;
            //Set the title
            $data["header"]["title"] = "Informazioni di track";
            //Set custom js
            $data["header"]["js"] = [];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("trackinginfo");
            //Render the view
            $view->render($data); 
        }
    }

}