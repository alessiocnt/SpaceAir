<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new AboutUsController(new ModelImpl());
$controller->execute();

?>