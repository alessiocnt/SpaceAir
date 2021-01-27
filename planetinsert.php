<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new PlanetInsertController(new ModelImpl());
$controller->execute();

?>