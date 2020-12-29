<?php

class Planet {
    private int $id;
    private string $name;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }
}

class PlanetBuilder {
    private int $id;
    private string $name;

    public function __construct() {}

    public function setId(int $id) : PlanetBuilder{
        $this->id = $id;
        return $this;
    }

    public function setName(string $name) : PlanetBuilder {
        $this->name = $name;
        return $this;
    }

    public function build() : Planet {
        return new Planet($this->id, $this->name);
    }
}

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

