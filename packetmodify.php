<?php 
require_once("./autoloaders/commonAutoloader.php");

$controller = new PacketModifyController(new ModelImpl());
$controller->execute();


?>