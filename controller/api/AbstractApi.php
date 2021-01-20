<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

abstract class AbstractApi {
    private $db;

    public function __construct(){
        $this->db = new DbManagerImpl("localhost", "root", "", "spaceair", 3306).getDb();
        session_start();
    }

    public function getDb() {
        return $this->db;
    }

    abstract public function execute();

}

?>