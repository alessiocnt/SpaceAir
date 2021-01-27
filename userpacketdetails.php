<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new UserPacketDetailsController(new ModelImpl());
$controller->execute();

?>