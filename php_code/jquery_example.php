<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$str =<<<TEXT
jQuery.noConflict();
    $.trim();
    $("#').click();
    .click(function(){});
    .bind("click",function(){});
    
Selectors
$('*') all
$('#')
$('.')
$('p') element
$('p:first')
$('#myform input[name=""]')
:checked
TEXT;

echo $str;
?>
