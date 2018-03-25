<?php

$x =<<<EOF
        //php 7.0 run time slow
        define('ANIMALS', [
    'dog',
    'cat',
    'bird'
]);
echo ANIMALS[1];
//php 5.3compile time
const  MY_CONST = '1';
//PHP 5.6 compile time
const MY_ARR = array('s','a','n');    
        
$z = 0;
// IDE SHOWS Error from below
if($z){
    const TEST2 ='12';
}else{
    const TEST3 = '13';
}

EOF;

echo nl2br($x);

        define('ANIMALS', [
    'dog',
    'cat',
    'bird'
]);
echo ANIMALS[1];

$y = 2;

if($y){
    define('TEST','12');
}else{
    define('TEST','13');
}
echo '<br/>';
echo TEST;

//php 5.3
const  MY_CONST = '1';
//PHP 5.6
const MY_ARR = array('s','a','n');    

echo '<br/>';
echo MY_CONST;

echo '<br/>';
echo MY_ARR[0];


