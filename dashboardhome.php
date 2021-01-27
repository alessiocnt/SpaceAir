<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new DashboardController(new ModelImpl());
$controller->execute();

?>