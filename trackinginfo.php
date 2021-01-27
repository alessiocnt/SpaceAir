<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new TrackingInfoController(new ModelImpl());
$controller->execute();

?>