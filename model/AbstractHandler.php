<?php


abstract class AbstractHandler {
    private ModelHelper $model;

    public function __construct(ModelHelper $model) {
        $this->model = $model;
    }
}

?>