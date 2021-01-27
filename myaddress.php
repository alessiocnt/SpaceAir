<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new MyAddressController(new ModelImpl());
$controller->execute();

?>