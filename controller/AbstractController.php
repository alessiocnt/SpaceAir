<?php

abstract class AbstractController implements Controller {
    private Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
        
        //Start secure session
        Utils::sec_session_start();
    }

    public function getModel() {
        return $this->model;
    }
}

?>