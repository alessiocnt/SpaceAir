<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/Model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/ModelHelper.php";
//Test
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/handler/TestHandler.php";

class ModelImpl implements Model, ModelHelper {
    private DbManager $dbManager;
    /**
     * @return DbManager the dbManager
     */
    public function getDbManager() : DbManager {
        return $this->$dbManager;
    }

    //Test
    public function getTestHandler() {
        return new TestHandler($this);
    }
}

?>