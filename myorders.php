<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new MyOrdersController(new ModelImpl());
$controller->execute();

?>