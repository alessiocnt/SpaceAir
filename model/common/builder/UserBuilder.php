<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class UserBuilder implements Builder{
    private int $id;
    private string $name = "";
    private string $surname = "";
    private $bornDate = "";
    private $telNumber = "";
    private string $imgProfile = "";
    private string $mail = "";
    private bool $newsletter = false; 

    public function createFromAssoc($assoc) {
        $pre = "set";
        foreach($assoc as $key=>$value) {
            $method = $pre . $key;
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return new User($this->id, $this->name, $this->surname, $this->bornDate, $this->telNumber, $this->imgProfile, $this->mail, $this->newsletter);
    }

    public function setIdUser($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setBorndate($date) {
        $this->bornDate = $date;
    }

    public function setPhone($phoneNumber) {
        $this->telNumber = $phoneNumber;
    }

    public function setProfileImg($img) {
        $this->imgProfile = $img;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setNewsletter($newsletter) {
        $this->newsletter = $newsletter;
    }
}

?>