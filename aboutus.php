<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$controller = new AboutUsController(new ModelImpl());
$controller->execute();

?>