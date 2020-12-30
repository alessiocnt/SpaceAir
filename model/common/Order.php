<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class PacketInOrder {
    private Package $packet;
    private int $quantity;

    public function __construct(Package $packet, int $quantity) {
        $this->packet = $packet;
        $this->quantity = $quantity;
    }

    /*
        Getters
    */
    public function getPacket() : Package {
        return $this->packet;
    }

    public function getQuantity() : int {
        return $this->quantity;
    }
}

/*
    Class that represent an Order
*/
class Order {
    private int $codOrder;
    private ?DateTime $purchaseDate;
    private float $total;
    private ?Address $destAddress;
    private ?OrderState $state;
    private ?User $user;
    private $packets = array();
    
    /*
        Base construct
        all optional unless the id, so we can create an object only with the id
        without using the Builder
    */
    public function __construct(int $codOrder, DateTime $purchaseDate = null, float $total = 0, Address $destAddress = null, OrderState $state = null, User $user = null) {
        $this->codOrder = $codOrder;
        $this->purchaseDate = $purchaseDate;
        $this->total = $total;
        $this->destAddress = $destAddress;
        $this->state = $state;
        $this->user = $user;
    }

    /*
        Getters
    */
    public function getCodOrder() : int {
        return $this->codOrder;
    }

    public function getPurchaseDate() : DateTime {
        return $this->purchaseDate;
    }

    public function getTotal() : float {
        return $this->total;
    }

    public function getDestAddress() : Address {
        return $this->destAddress;
    }

    public function getState() : OrderState {
        return $this->state;
    }

    public function getUser() : User{
        return $this->user;
    }

    public function getPackets() {
        return $this->packets;
    }

    /* 
        Setter 
    */
    public function setPurchaseDate(DateTime $purchaseDate) {
        $this->purchaseDate = $purchaseDate;
    }

    public function setDestAddress(Address $destAddress) {
        $this->destAddress = $destAddress;
    }

    public function setState(OrderState $state) {
        $this->state = $state;
    }

    public function setUser(User $user) {
        $this->user = user;
    }

}

?>