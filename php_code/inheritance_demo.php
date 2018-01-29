<?php

$cy = new Cylinder(5);

echo "<br/> Area ".$cy->getArea();
echo "<br/> Length ".$cy->getArea();
echo "<br/> In php Parent constructor not called automatically like java";
class Circle{
    public  $radious;
    
    public function __construct($radious=1){
        $this->radious = $radious;
        echo "In Circle..";
    }
    
    public function getArea(){
        return 2 * pi()*$this->radious * $this->radious;
    }
    
}

class Cylinder extends Circle{
    protected $length;
    public function __construct($length=1){
        parent::__construct();
        $this->length = $length;
        echo "In Cylinder";
    }
    
    public function getLength(){
        return $this->length;
    }
    public function getArea() {
        return parent::getArea() * $this->length;
    }
}
