<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class AddressBuilder implements Builder{
    private int $codAddress;
    private string $via = "";
    private string $civico = "";
    private string $citta = "";
    private string $provincia = "";
    private string $cap = "";
    private ?User $user = null;

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new Address($this->codAddress, $this->via, $this->civico, $this->citta, $this->provincia, $this->cap, $this->user);
    }

    public function setCodAddress($cod) {
        $this->codAddress = $cod;
    }

    public function setVia($via) {
        $this->via = $via;
    }

    public function setCivico($civico) {
        $this->civico = $civico;
    }

    public function setCitta($citta) {
        $this->citta = $citta;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function setCap($cap) {
        $this->cap = $cap;
    }

    public function setIdUser($idUser) {
        $this->user = new User($idUser);
    }
    
}
?>