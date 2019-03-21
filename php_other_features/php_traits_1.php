<?php
/*
 * the methods of a trait override inherited methods from the parent class
   the methods defined in the current class override methods from a trait
 */
trait Hello
{
    function sayHello(){
        return "Hello";
    }
    function sayWorld(){
        return "Trait World";
    }
    function sayHelloWorld()
    {
        echo $this->sayHello()." ".$this->sayWorld();
        echo '<br/>';
    }
    function sayBaseWorld()
    {
        echo $this->sayHello()." ". parent::sayWorld();
        echo '<br/>';
    }
}

class Base
{
    function sayWorld()
    {
        return "Base World";
    }
}

class HelloWorld extends Base
{
    use Hello;
    function sayWorld() {
        return "World";
    }
}

$h = new HelloWorld();

$h->sayHelloWorld();
$h->sayBaseWorld();



