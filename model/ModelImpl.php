<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


//Test
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/handler/TestHandler.php";

class ModelImpl implements Model, ModelHelper {
    private DbManager $dbManager;

    public function __construct(){
        $this->dbManager = new DbManagerImpl("localhost", "root", "", "blogtw", 3306);       
    }
    
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