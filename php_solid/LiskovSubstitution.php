<?php
/**
 * objects should be replaceable by their subtypes without altering how the 
 * program works. In other words, derived classes must be substitutable for 
 * their base classes without causing errors.
 */
interface Quadrilateral
{
    public function setHeight($h);
    public function setWidth($w);
    public function getArea();
}


class Rectangle implements Quadrilateral
{
    public function setWidth($w) { $this->width = $w; }
    public function setHeight($h) { $this->height = $h; }
    public function getArea() { return $this->height * $this->width; }
}

class Square implements Quadrilateral
{
    public function setWidth($w) { $this->width = $w; $this->height = $w; }
    public function setHeight($h) { $this->height = $h; $this->width = $h; }
    public function getArea() { return $this->height * $this->width; }
}
