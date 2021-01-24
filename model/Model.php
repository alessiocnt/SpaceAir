<?php

interface Model {
    public function getUserHandler();
    public function getPlanetHandler();
    public function getPacketHandler();
    public function getCartHandler();
    public function getAddressHandler();
    public function getUserInfoHandler();
    public function getOrderHandler();
    public function getReviewHandler();
    public function getNotificationDispatcher();
    //Test
    public function getTestHandler();
}

?>