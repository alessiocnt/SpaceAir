<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class CookieController extends AbstractController {

    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        //Transform in data for the view
        $data["data"] = "";
        //Set the title
        $data["header"]["title"] = "Cookie Policy";
        //Set custom js
        $data["header"]["js"] = [];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new GenericView("cookiepolicy");
        //Render the view
        $view->render($data);

    }
}
?>