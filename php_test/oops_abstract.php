<?php
abstract  class abs_class{
    
    protected function __construct(){
     echo "hello";   
    }
}


class abs_child1 extends abs_class{
    
    public function __construct() {
        parent::__construct();
    }
    
}

$test1 = new abs_child1();

interface interface1{
    const test = "ddd";
   
}

interface interface2 extends interface1{
    const test2 = "ddd";
   
}


