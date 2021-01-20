<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$controller = new DestinationsController(new ModelImpl());
$controller->execute();

?>