<?php

class MyOrdersController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        //Get User data
        $userInfoHandler = $this->getModel()->getUserInfoHandler();
        $ordersHandler = $this->getModel()->getOrdersHandler();
        $currentUser = $userInfoHandler->getUserInfo(new User(Utils::getUserId()));
        
        $orders = $ordersHandler->getOrders($currentUser);
        
        $data["data"]["orders"] = $orders;
        //Set the title
        $data["header"]["title"] = "Ordini";
        //Set custom js
        $data["header"]["js"] = [];
        //Set custom css
        $data["header"]["css"] = [];
        //Create the view
        $view = new GenericView("myorders");
        //Render the view
        $view->render($data); 
    }

}