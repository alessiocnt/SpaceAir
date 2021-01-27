<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new CartController(new ModelImpl());
$controller->execute();

?>