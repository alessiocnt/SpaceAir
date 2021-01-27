<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new LoginController(new ModelImpl());
$controller->execute();

?>