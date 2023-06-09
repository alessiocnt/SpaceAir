<?php


class ModelImpl implements Model, ModelHelper {
    private DbManager $dbManager;

    public function __construct(){
        $this->dbManager = new DbManagerImpl("localhost", "sc_space_user", "HjdWASFE6cAwJ4nu", "spaceair", 3306);       
        //$this->dbManager = new DbManagerImpl("localhost", "root", "", "spaceair", 3306);       
    }
    
    /**
     * @return DbManager the dbManager
     */
    public function getDbManager() : DbManager {
        return $this->dbManager;
    }

    public function getUserHandler() {
        return new UserHandler($this);
    }

    public function getPlanetHandler() {
        return new PlanetHandler($this);
    }

    public function getPacketHandler() {
        return new PacketHandler($this);
    }

    public function getCartHandler() {
        return new CartHandler($this);
    }
    
    public function getNotificationDispatcher() {
        return new NotificationDispatcher($this);
    }

    public function getAddressHandler() {
        return new AddressHandler($this);
    }

    public function getUserInfoHandler() {
        return new UserInfoHandler($this);
    }

    public function getOrderHandler() {
        return new OrderHandler($this);
    }

    public function getOrdersHandler() {
        return new OrdersHandler($this);
    }

    public function getReviewHandler() {
        return new ReviewHandler($this);
    }

    public function getAdminInfoHandler() {
        return new AdminInfoHandler($this);
    }

    public function getTrackInfoHandler() {
        return new TrackInfoHandler($this);
    }
}

?>