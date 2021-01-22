<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();

if(!isset($_POST["Via"])) {
    die("Errore non è possibile accedere alla pagina");
} else {

    $currentUser = new User(Utils::getUserId());
    $userInfoHandler = $model->getUserInfoHandler();
    
    $data["Via"] = $_POST["Via"];
    $data["Civico"] = $_POST["Civico"];
    $data["Citta"] = $_POST["Citta"];
    $data["Provincia"] = $_POST["Provincia"];
    $data["Cap"] = $_POST["Cap"];
    $id = $currentUser->getId();

    //Create address
    $builder = new AddressBuilder();
    $address = $builder->createFromAssoc($data);
    $address->setUser($currentUser);
    if($result = $userInfoHandler->existsAddress($address, $id)) {
        die('Indirizzo già esistente');
    }
    $result = $userInfoHandler->addAddress($address);
    if($result) {
        echo 'Indirizzo aggiunto correttamente';
    } else {
        die('Indirizzo non aggiunto');
    }
    
}
