<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$controller = new MyAddressController(new ModelImpl());
$controller->execute();

?>