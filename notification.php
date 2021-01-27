<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new NotificationController(new ModelImpl());
$controller->execute();

?>