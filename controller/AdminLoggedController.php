<?php

abstract class AdminLoggedController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    //Can't be overriden in child classes
    final public function execute() {
        /*
        Control if user is logged:
            - if user is logged: executePage() --> ONLY OVERRIDE THIS IN OUR CONTROLLER (for controller where user has to be logged)
            - if not -> redirect to login.php
        */
        if($this->checkLogin()) {
            $this->executePage();
        } else {
            //Render Login
            header("Location:login.php");
        }
    }

    //ONLY OVERRIDE THIS IN OUR CONTROLLER (for controller where user has to be logged)
    abstract protected function executePage();

    private function checkLogin() {
        return $this->getModel()->getUserHandler()->checkLogin(UserHandler::$LOGINOKADMIN);
    }

}

?>