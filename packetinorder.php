<?php
require_once("./autoloaders/commonAutoloader.php");

$controller = new PacketInOrderController(new ModelImpl());
$controller->execute();

?>