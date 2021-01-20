<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$controller = new DestinationsAdminController(new ModelImpl());
$controller->execute();

?>