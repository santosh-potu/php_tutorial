<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function demoStatic(){
    static $static_number = 1;
    $local_varible = 1;
    $static_number++;
    $local_varible++;
    
    echo " Static variable:".$static_number.' Local varibale:'.$local_varible.'<br/>';
    
}
function isEven($number = 0 ){
   global  $even_decider;
    $result = 0;
    if($number){
        $result = !($number % $even_decider);
    }
    $result = ($result?'true':'false');
    return $result;
}
function add($num1,$num2,$num3=0){
    
    return $num1 + $num2 + $num3;
    
}

?>
