<?php

$x=<<<EOF
    \$name = 'car';
    \$car = 'Maruthi';
    
    echo \$name;
    echo $\$name;

    \$name = 'car';
    \$car = array('name'=>'Jetta','year'=>2010);
    
    echo $\$name['name'];
    // php 5 warning: Illegal string offset 'name'
    //Evaluated as \${\$name['name']}

    // php 7 Jetta
    //Evaluated as ($\$name)['name']

    \$name = 'car';
    \$car = array(
        'type'=> array(
            'brand' => 'maruthi' , 'model'=>'jetta'
            ), 'year' => '2010'
            );
    echo $\$name['type']['model'];
    // php 5 warning: Illegal string offset 'type'
    //Evaluated as \${\$name['type']['model']}

    // php 7 Jetta
    //Evaluated as ($\$name)['type']['model']

    \$model= 'engine';
    
    \$car = (Object) array('engine'=> array('name'=>'Jetta'));
    
    echo \$car->\$model['name'];
    //PHP 5: \$car->{\$model['name']}
    //PHP 7: (\$car->\$model)['name']
    class Car{
        static \$model;
    }
    
    Car::\$model['name']='Jetta';
    
    
    echo Car::\$model['name'];
    //PHP 5: Car::{\$model['name']}
    //PHP 7: (Car::\$model)['name']
    
EOF;

echo nl2br($x);

try{

    $name = 'car';
    $car = 'Maruthi';
    echo '<br/>';
    echo $name;
    echo '<br/>';
    echo $$name;

    $name = 'car';
    $car = array('name'=>'Jetta','year'=>2010);
    echo '<br/>';
    echo $$name['name'];
    // php 5 warning: Illegal string offset 'name'
    //Evaluated as ${$name['name']}

    // php 7 Jetta
    //Evaluated as ($$name)['name']

    $name = 'car';
    $car = array(
        'type'=> array(
            'brand' => 'maruthi' , 'model'=>'jetta'
            ), 'year' => '2010'
            );
    echo '<br/>-> ';
    echo $$name['type']['model'];
    // php 5 warning: Illegal string offset 'type'
    //Evaluated as ${$name['type']['model']}

    // php 7 Jetta
    //Evaluated as ($$name)['type']['model']

    $model= 'engine';
    
    $car = (Object) array('engine'=> array('name'=>'Jetta'));
    
    echo '<br/>';
    echo $car->$model['name'];
    //PHP 5: $car->{$model['name']}
    //PHP 7: ($car->$model)['name']
    class Car{
        static $model;
    }
    
    Car::$model['name']='Jetta';
    echo '<br/>';
    
    echo Car::$model['name'];
    //PHP 5: Car::{$model['name']}
    //PHP 7: (Car::$model)['name']
    
} catch (Exception $ex) {
   echo $ex->getMessage();
}
