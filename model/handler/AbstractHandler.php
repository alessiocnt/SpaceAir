<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

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