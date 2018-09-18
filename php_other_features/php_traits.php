<?php

trait Singleton{
    private static $instance;
    
    public static function getIntance(){
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

class DbReader extends ArrayObject{
    use Singleton;
}

class FileReader{
    use Singleton;
    
}

$a = DbReader::getIntance();
$b = FileReader::getIntance();

echo "<pre>";
var_dump($b);
var_dump($a);
echo "</pre>";

trait Hello
{
    function sayHello(){
        return "Hello";
    }
}

trait World
{
    function sayWorld(){
        return "World";
    }
}

trait HelloWorld{
    use Hello,World;
}

class MyWorld
{
    use HelloWorld;
}

$world = new MyWorld;

echo "<br/>".$world->sayHello().' - '.$world->sayWorld()."<br/>";









