<?php
/**
 * classes should be open for extension, but closed for modification. 
 * Essentially meaning that classes should be extended to change functionality,
 *  rather than being altered.
  */
interface Shape {
   public function area();
}
 
class Rectangle implements Shape {
  public function area() {
    return $this->width * $this->height;
  }
}
 
class Circle implements Shape {
  public function area() {
    return $this->radius * $this->radius * pi();
  }
}

class Board {
  public $shapes;
 
  public function setShapes($shapes){
      $this->shapes = $shapes;
  }
  public function calculateArea() {
    $area = 0;
    foreach ($this->shapes as $shape) {
      $area+= $shape->area();
    }
    return $area;
  }
}