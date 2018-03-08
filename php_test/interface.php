<?php

interface interface1{
    // you can not add variables so
    const test = "ddd";
    
   
}

interface interface2 extends interface1{
    //you can not override const so..
    const test2 = "ddd";
   
}
