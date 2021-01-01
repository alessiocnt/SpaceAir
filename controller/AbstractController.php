<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/Controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/Model.php";

abstract class AbstractController implements Controller {
    private Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function getModel() {
        return $this->model;
    }
}

?>