<?php


interface A{
	public function doSomeFun();
}

interface B{
	public function doSomeFun();
}

abstract class C{
	abstract protected function doSomeFun();
}

class ImplementDemo extends C implements A,B  {

    public static function test(){
        $a = new ImplementDemo();
        $a= (object)$a; //u can not cast other classes
        //$b = B(new ImplementDemo());
        //$c = C(new ImplementDemo());
        $a->doSomeFun();
        //$b->doSomeFun();
        //$c->doSomeFun();


    }
	public function doSomeFun() {
		echo "Be productive<br/> ";
	}
}

		
ImplementDemo::test();
