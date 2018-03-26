<?php
$x = <<<EOF
        class A { private \$x =1;}

\$getX = function(){ return \$this->x;};

//Pre PHP 7
\$getXCB = \$getX->bindTo(new A,'A');

echo \$getXCB();

//PHP 7

echo \$getX->call(new A);
        
EOF;

echo nl2br($x);

class A { private $x =1;}

$getX = function(){ return $this->x;};

//Pre PHP 7
$getXCB = $getX->bindTo(new A,'A');
echo '<br/>';
echo $getXCB();

//PHP 7
echo '<br/>';
echo $getX->call(new A);