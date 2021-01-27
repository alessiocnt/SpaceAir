<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new DestinationsController(new ModelImpl());
$controller->execute();

?>