<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$controller = new PlanetModifyController(new ModelImpl());
$controller->execute();

?>