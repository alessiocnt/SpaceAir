<?php

class ControllerImpl implements Controller {
    private Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function execute() {

    }
}

?>