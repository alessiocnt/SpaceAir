<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new SignupController(new ModelImpl());
$controller->execute();

?>