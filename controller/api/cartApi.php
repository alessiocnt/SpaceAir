<?php

/* Da json prendo i dati, ho un array che mi associa id dell'elemento e
id che uso all'interno della pagina, cosi' nella pagina non uso gli id veri
poi associo i click con l'id falso e dall'id falso ottengo l'id vero. 
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

if(!isset($_POST["id"])) {
    echo("Errore non è possibile accedere alla pagina");
}


$model = new ModelImpl();
$packetHandler = $model->getPacketHandler();
$cartHandler = $model->getCartHandler();
$cartHandler->changeQuantity($_POST["id"], $_POST["qnt"], $_POST["cod"]);
$packet = $packetHandler->getPacketById($_POST["id"]);
$price = $_POST["qnt"] * $packet->getPrice();
echo $price;


?>

