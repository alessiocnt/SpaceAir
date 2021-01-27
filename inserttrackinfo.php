<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new InsertTrackInfoController(new ModelImpl());
$controller->execute();

?>