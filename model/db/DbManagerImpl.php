<?php


class DbManagerImpl implements DbManager {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection to database failed: " . $db->connect_error);
        }
    }

    public function getDb() {
        return $this->db;
    }

}

?>