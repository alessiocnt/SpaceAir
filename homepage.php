<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new HomePageController(new ModelImpl());
$controller->execute();

?>