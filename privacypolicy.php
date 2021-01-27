<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new PrivacyController(new ModelImpl());
$controller->execute();

?>