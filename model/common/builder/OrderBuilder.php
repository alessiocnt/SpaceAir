<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class OrderBuilder implements Builder{
    private int $codOrder;
    private ?DateTime $purchaseDate = null;
    private float $total = 0;
    private ?Address $destAddress = null; 
    private ?OrderState $state = null;
    private ?User $user = null;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new Order($this->codOrder, $this->purchaseDate, $this->total, $this->destAddress, $this->state, $this->user);
    }

    public function setCodOrder($codOrder) {
        $this->codOrder = $codOrder;
    }

    public function setPurchaseDate($purchaseDate) {
        $this->purchaseDate = DateTime::createFromFormat("Y-m-d H:i:s", $purchaseDate);
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setDestAddressCode($destAddrCode) {
        $this->destAddress = new Address($destAddrCode);
    }

    public function setState($stateId) {
        $this->state = new OrderState($stateId);
    }

    public function setIdUser($userId) {
        $this->user = new User($userId);
    }

}
?>