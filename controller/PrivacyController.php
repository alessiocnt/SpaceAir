<?php

class PrivacyController extends AbstractController {

    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        //Transform in data for the view
        $data["data"] = "";
        //Set the title
        $data["header"]["title"] = "Privacy Policy";
        //Set custom js
        $data["header"]["js"] = [];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new GenericView("privacypolicy");
        //Render the view
        $view->render($data);

    }
}
?>