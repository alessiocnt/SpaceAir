<?php 
//include_once autoloaders/commonAutoloader.php;
include '../Planet.php';
include '../PlanetBuilder.php';

$builder = new PlanetBuilder();
$builder->setId(1)->setName('Luna');
$planet = $builder->build();
echo $planet->getId();  
echo $planet->getName();  
$builder->setId(2)->setName('Marte');
$planet2 = $builder->build();
echo $planet2->getId();  
echo $planet2->getName(); 

?>