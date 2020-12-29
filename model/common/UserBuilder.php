<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class UserBuilder {
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

    public function setIdUtente($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->name = $nome;
    }

    public function setCognome($cognome) {
        $this->surname = $cognome;
    }

    public function setData_nascita($data) {
        $this->bornDate = $data;
    }

    public function setTelefono($telefono) {
        $this->telNumber = $telefono;
    }

    public function setImg_profilo($img) {
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