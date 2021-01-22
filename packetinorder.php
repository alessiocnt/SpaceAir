<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$controller = new PacketInOrderController(new ModelImpl());
$controller->execute();

?>