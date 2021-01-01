<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/ModelHelper.php";

abstract class AbstractHandler {
    private ModelHelper $model;

    public function __construct(ModelHelper $model) {
        $this->model = $model;
    }

    protected function getModelHelper() : ModelHelper {
        return $this->model;
    }
}

?>