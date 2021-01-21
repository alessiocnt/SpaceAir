<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$controller = new FlightDetailsController(new ModelImpl());
$controller->execute();

?>