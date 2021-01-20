<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class TestController extends AbstractController {

    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {

        //Create general notification
        /*$notificationData = ["DateTime" => date('Y-m-d H:i:s'),"Title" => "Benvenuto","Description" => "Grazie per essere entrato a fare parte della famiglia SpaceAir!","Type"=> NotificationType::GENERAL];
        $builder = new NotificationBuilder();
        $notification = $builder->createFromAssoc($notificationData);
        var_dump($notification);*/

        $this->getModel()->getNotificationDispatcher()->createGeneral("Titolo","Ciao belli", new User(1));



        //Get Data from model
        $name = $this->getModel()->getTestHandler()->getName();
        //Transform in data for the view
        $data["data"]["name"] = $name;
        //Set the title
        $data["header"]["title"] = "Test";
        //Set custom js
        $data["header"]["js"] = ["https://canvasjs.com/assets/script/canvasjs.min.js", "/spaceair/view/js/dashboard.js"];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new TestView();
        //Render the view
        $view->render($data);

    }
}
?>