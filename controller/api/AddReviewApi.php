<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/api/UserLoggedApi.php");

if(!isset($_POST["Titolo"])) {
    die("Errore. Non è possibile registrare la recensione.");
} else {
    $reviewHandler = $model->getReviewHandler();
    $planetHandler = $model->getPlanetHandler();
    $planetId = $planetHandler->searchPlanetByName($_POST["Pianeta"])[0]->getCodPlanet();
    $data["DateTime"] = date("Y-m-d H:i:s");
    $data["Title"] = $_POST["Titolo"]; 
    $data["Description"] = $_POST["Descrizione"];
    $data["Rating"] = $_POST["Valutazione"];
    $data["IdUser"] = Utils::getUserId();
    $data["CodPlanet"] = $planetId;
    
    $builder = new ReviewBuilder();
    $review = $builder->createFromAssoc($data);
    $result = $reviewHandler->addReview($review);
    if($result == false) {
        die('Impossibile aggiungere la recensione.');
    } else {
        echo 'Recensione aggiunta correttamente.';
    }
}
