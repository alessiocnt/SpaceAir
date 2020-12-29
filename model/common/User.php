<?php

/*
    Class that represent the user of our website.
*/
class User {
    private int $id;
    private string $name;
    private string $surname;
    private $bornDate;
    private $telNumber;
    private string $imgProfile;
    private string $mail;
    private bool $newsletter;
    private $addresses = array(); //Array to store addresses
    private $orders = array(); //Array to store orders

    /*
        Base construct
    */
    public function __construct(int $id, string $name = "",string $surname = "", $bornDate = "", $telNumber = "", $imgProfile = "", $mail = "", $newsletter = false) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->bornDate = $bornDate;
        $this->telNumber = $telNumber;
        $this->imgProfile = $imgProfile;
        $this->mail = $mail;
        $this->newsletter = (bool) $newsletter;
    }

    /*
        Create user from database associative array
    */
    public static function createFromAssoc($associativeArray) {
        $id = ""; 
        $name = "";
        $surname = ""; 
        $bornDate = "";
        $telNumber = "";
        $imgProfile = "";
        $mail = "";
        $newsletter = "";

        if(array_key_exists("IdUtente", $associativeArray)) {
            $id = $associativeArray["IdUtente"]; 
        }

        if(array_key_exists("Nome", $associativeArray)) {
            $name = $associativeArray["Nome"];
        }

        if(array_key_exists("Cognome", $associativeArray)) {
            $surname = $associativeArray["Cognome"];
        }

        if(array_key_exists("Data_nascita", $associativeArray)) {
            $bornDate = $associativeArray["Data_nascita"];
        }

        if(array_key_exists("Telefono", $associativeArray)) {
            $telNumber = $associativeArray["Telefono"];
        }

        if(array_key_exists("Img_profilo", $associativeArray)) {
            $imgProfile = $associativeArray["Img_profilo"];
        }

        if(array_key_exists("Mail", $associativeArray)) {
            $mail = $associativeArray["Mail"];
        }

        if(array_key_exists("Newsletter", $associativeArray)) {
            $newsletter = $associativeArray["Newsletter"];
        }

        if(array_key_exists("Addresses", $associativeArray)) {
            //If passed also the array of addresses
            $addresses = $associativeArray["Addresses"];
        }

        if(array_key_exists("Orders", $associativeArray)) {
            //If passed also the array of orders
            $addresses = $associativeArray["Orders"];
        }

        return new User($id, $name, $surname, $bornDate, $telNumber, $imgProfile, $mail, $newsletter);
    }

    /*
        Getters
    */
    public function getId() : int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getSurname() : string {
        return $this->surname;
    }

    public function getBornDate() {
        return $this->bornDate;
    }

    public function getTelNumber() {
        return $this->telNumber;
    }

    public function getImgProfile() {
        return $this->imgProfile;
    }

    public function getMail() {
        return $this->mail;
    }

    public function hasNewsletter() {
        return $this->newsletter == 1;
    }


    /*
        External relationships
    */

    public function setAddresses($addresses) {
        $this->addresses = $addresses;
    }

    public function getAddresses() {
        //NOTICE: array in php are treates as copy
        return $this->addresses;
    }

    public function setOrders($orders) {
        $this->orders = $orders;
    }

    public function getOrders() {
        //NOTICE: array in php are treates as copy
        return $this->orders;
    }
}


?>

