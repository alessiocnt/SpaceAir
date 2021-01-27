<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new InterestController(new ModelImpl());
$controller->execute();

?>