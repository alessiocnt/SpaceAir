<?php

/*
    Class that represent the user of our website.
*/
class User {
    private int $id;
    private string $name;
    private string $surname;
    private string $password;
    private $bornDate;
    private $telNumber;
    private $imgProfile;
    private string $mail;
    private bool $newsletter;
    private $addresses = array(); //Array to store addresses
    private $orders = array(); //Array to store orders
    private $interests = array();

    /*
        Base construct
        all optional unless the id, so we can create an object only with the id
        without using the Builder
    */
    public function __construct(int $id, string $name = "",string $surname = "", $bornDate = "", $telNumber = "", $imgProfile = "", $mail = "", $newsletter = false, $password = "") {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->bornDate = $bornDate;
        $this->telNumber = $telNumber;
        $this->imgProfile = $imgProfile;
        $this->mail = $mail;
        $this->newsletter = (bool) $newsletter;
        $this->password = $password;
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

    public function getPhone() {
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

    public function getPassword() {
        return $this->password;
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

    public function getInterests() {
        return $this->interests;
    }

    public function setInterests($interests) {
        $this->interests = $interests;
    }
}


?>

