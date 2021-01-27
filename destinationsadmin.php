<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new DestinationsAdminController(new ModelImpl());
$controller->execute();

?>