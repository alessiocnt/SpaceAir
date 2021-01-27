<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new FlightDetailsController(new ModelImpl());
$controller->execute();

?>