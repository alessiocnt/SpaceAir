<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/model/ModelImpl.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/TestController.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/Controller.php";

$controller = new TestController(new ModelImpl());
$controller->execute();

?>