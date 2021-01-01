<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class TestHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    } 

    public function getName() {
        return "Andrea";
    }
}

?>