<?php

class ModelImpl implements Model, ModelHelper {
    private DbManager $dbManager;
    /**
     * @return DbManager the dbManager
     */
    public function getDbManager() : DbManager {
        return $this->$dbManager;
    }
}

?>