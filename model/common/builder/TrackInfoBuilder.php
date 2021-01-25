<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class UserBuilder implements Builder{
    private Order $order;
    private DateTime $date;
    private string $citta;
    private string $description;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new TrackInfo($this->order, $this->date, $this->citta, $this->description);
    }

    public function setCodOrder($codOrder) {
        $this->order = new Order($codOrder);
    }

    public function setDateTime($dateTime) {
        $this->order = DateTime::createFromFormat("Y-m-d H:i:s", $dateTime);
    }

    public function setCitta($citta) {
        $this->citta = $citta;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}