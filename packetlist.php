<?php 
require_once("./autoloaders/commonAutoloader.php");

$controller = new PacketListController(new ModelImpl());
$controller->execute();


?>