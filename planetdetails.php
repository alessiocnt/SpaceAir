<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new PlanetDetailsController(new ModelImpl());
$controller->execute();

?>