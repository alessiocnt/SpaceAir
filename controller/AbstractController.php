<?php

abstract class AbstractController implements Controller {
    private Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }
}

?>