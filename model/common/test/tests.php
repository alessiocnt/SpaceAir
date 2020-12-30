<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

$array = array("IdUser" => 1000000, "Name" => "Andrea", "Surname" => "Giulianelli", "Mail" => "sdfsfdfwe");

//Test static factory
//$user = User::createFromAssoc($array);
//echo $user->getName();


//Test myDynamicBuilder
$builder = new UserBuilder();
$user2 = $builder->createFromAssoc($array);
echo $user2->getId() . " - " . $user2->getName();

echo "<br>";

$array = array("CodAddress" => 2, "Via" => "Aucciu", "IdUser" => 34);
$builder = new AddressBuilder();
$address = $builder->createFromAssoc($array);
echo $address->getCodAddress() . " - " . $address->getVia() . " - " . $address->getUser()->getId();


echo "<br>";

$array = array("CodOrder" => 100, "PurchaseDate" => "2020-01-01 20:10:00", "Total" => 400.40);
$builder = new OrderBuilder();
$order = $builder->createFromAssoc($array);
echo $order->getCodOrder() . " - " . $order->getTotal() . "$ - " . $order->getPurchaseDate()->format('Y-m-d H:i:s');
?>