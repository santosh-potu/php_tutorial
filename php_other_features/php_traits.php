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
