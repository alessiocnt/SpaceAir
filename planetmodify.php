<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new PlanetModifyController(new ModelImpl());
$controller->execute();

?>