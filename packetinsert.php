<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new PacketInsertController(new ModelImpl());
$controller->execute();

?>