<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/ModelHelper.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/handler/AbstractHandler.php";

class TestHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    } 

    public function getName() {
        return "Andrea";
    }
}

?>