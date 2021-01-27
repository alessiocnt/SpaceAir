<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new ProfileController(new ModelImpl());
$controller->execute();

?>