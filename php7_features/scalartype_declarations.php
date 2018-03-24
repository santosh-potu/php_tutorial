<?php
declare(strict_types=1);

set_include_path('..'.DIRECTORY_SEPARATOR.'php_code'.DIRECTORY_SEPARATOR);
require_once 'library'.DIRECTORY_SEPARATOR.'config.php';
error_reporting(E_ALL);
ini_set('display_errors','off');
ini_set('log_errors','on');

$x =<<<EOF
        // Coercive mode if not strict
    function sumOfInts(int ...$ints){
        return array_sum($ints);
    }

    var_dump(sumOfInts(2, '3', 4.1));
EOF;
echo nl2br($x);
try{
    // Coercive mode if not strict
    function sumOfInts(int ...$ints){
        return array_sum($ints);
    }

    var_dump(sumOfInts(2, '3', 4.1));
    echo "<br/>";



    var_dump(sumOfInts(2, '3', 4.1));
}catch(Throwable $t){
    echo "<br/> error is...<br/>";
    echo $t->getMessage();
    error_log($t->getMessage());
    throw $t;
}
