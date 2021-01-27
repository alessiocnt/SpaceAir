<?php 
require_once("./autoloaders/commonAutoloader.php");

$controller = new PaymentController(new ModelImpl());
$controller->execute();


?>