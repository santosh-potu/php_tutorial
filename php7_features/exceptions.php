<?php
ini_set('display_errors', 'on');
require_once '../php_code/library'.DIRECTORY_SEPARATOR.'config.php';

try{
   $x->test(); 
} catch (Error $ex) {
    echo "<pre>";
    print_r($ex);
    echo "</pre>";
    
}

try{
   $x = 1%0;
} catch (Error $ex) {
    echo "<pre>";
    print_r($ex);
    echo "</pre>";
    
}

try{
    require 'xyz.php';
} catch (Throwable $ex) {
   echo "<pre>";
   print_r($ex);
   echo "</pre>";
   die();
}