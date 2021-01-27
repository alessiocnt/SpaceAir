<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new CookieController(new ModelImpl());
$controller->execute();

?>