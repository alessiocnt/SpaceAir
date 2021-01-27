<?php


/*
    Class that represent an address
*/
class Address {
    private int $codAddress;
    private string $via;
    private string $civico;
    private string $citta;
    private string $provincia;
    private string $cap;
    private ?User $user;

    /*
        Base construct
        all optional unless the id, so we can create an object only with the id
        without using the Builder
    */
    public function __construct(int $codAddress, string $via = "", string $civico = "", string $citta = "", string $provincia = "", string $cap = "", User $user = null)  {
        $this->codAddress = $codAddress;
        $this->via = $via;
        $this->civico = $civico;
        $this->citta = $citta;
        $this->provincia = $provincia;
        $this->cap = $cap;
        $this->user = $user;
    }

    /*
        Getters
    */
    public function getCodAddress() : int {
        return $this->codAddress;
    }

    public function getVia() : string {
        return $this->via;
    }

    public function getCivico() : string {
        return $this->civico;
    }

    public function getCitta() : string {
        return $this->citta;
    }

    public function getProvincia() : string {
        return $this->provincia;
    }

    public function getCap() : string {
        return $this->cap;
    }

    public function getUser() : User {
        return $this->user;
    }

    public function toString() : string {
        return "Via " . $this->via . " " . $this->civico;
    }

    public function toSecondaryInfo() : string {
        return $this->citta . ", " . $this->provincia . ", " . $this->cap;
    }

    /*
        Setter
    */
    public function setUser(User $user) {
        $this->user = $user;
    }
    
}
?>