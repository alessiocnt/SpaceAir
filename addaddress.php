<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new AddAddressController(new ModelImpl());
$controller->execute();

?>