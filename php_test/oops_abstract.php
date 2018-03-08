<?php
ini_set('display_errors', 'on');
require_once '../php_code/library'.DIRECTORY_SEPARATOR.'config.php';


abstract  class abstract_class{
//abstract allows constructor    
    protected function __construct(){
     echo "parent constructor <br/>";
     $this->test();
    }
    
    // fincal function test2();
    // private function test1();
    // function test4();
    // above are errors 500 status
    private function test(){
      echo " abstract allows private function <br/>";   
    }
    
    // by default public
    function test3(){
        echo " Test3 <br/>";
    }
}


class abs_child1 extends abstract_class{
    
    public function __construct() {
        echo "Doing something before calling parent constructor <br/>";
        parent::__construct();
    }
    
}

class abs_child2 extends abs_child1{
    
    public function  test(){
        echo "other test function it is public and overriden from private<br/>";
        $this->test3();
    }
    
    /* private function test3() {
        echo " test3 - you cannot override as private from public <br/>";
    }
     * PHP Fatal error:  Access level to abs_child2::test3() must be public (as in class abstract_class) in /var/www/html/php_tutorial/php_test/oops_abstract.php on line 48

     */
    
}

$test1 = new abs_child1();
$test2 = new abs_child2();
$test2->test();

class abs_child3 extends abstract_class{
    
}

try{
    $test3 = new abs_child3();
}catch(Error $e){
    echo "You cannot call Protected function from out side"
    . " even if it is constructor hence error thrown<br/>";
    echo $e->getMessage();
}




