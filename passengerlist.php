<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new PassengerListController(new ModelImpl());
$controller->execute();

?>