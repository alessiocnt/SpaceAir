<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$array = array("IdUtente" => 1000000, "Nome" => "Andrea", "Cognome" => "Giulianelli", "Mail" => "sdfsfdfwe");

$user = User::createFromAssoc($array);
echo $user->getName();


?>