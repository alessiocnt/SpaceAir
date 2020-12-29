<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$array = array("IdUtente" => 1000000, "Nome" => "Andrea", "Cognome" => "Giulianelli", "Mail" => "sdfsfdfwe");

//Test static factory
//$user = User::createFromAssoc($array);
//echo $user->getName();


//Test myDynamicBuilder
$builder = new UserBuilder();
$user2 = $builder->createFromAssoc($array);
echo $user2->getId() . " - " . $user2->getName();


?>