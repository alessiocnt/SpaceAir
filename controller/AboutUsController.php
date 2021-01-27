<?php

class AboutUsController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        $reviewHandler = $this->getModel()->getReviewHandler();
        $data["data"]["reviews"] = $reviewHandler->getRandomReviewAllPlanets(5);
        $data["header"]["title"] = "Su di Noi";
        $data["header"]["js"] = [];
        $data["header"]["css"] = [];
        $view = new GenericView("aboutus");
        $view->render($data); 
    }
}
?>