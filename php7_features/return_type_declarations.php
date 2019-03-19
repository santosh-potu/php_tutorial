<?php
declare(strict_types=1);

set_include_path('..'.DIRECTORY_SEPARATOR.'php_code'.DIRECTORY_SEPARATOR);
require_once 'library'.DIRECTORY_SEPARATOR.'config.php';
error_reporting(E_ALL);
ini_set('display_errors','off');
ini_set('log_errors','on');

$x =<<<'EOF'
        declare(strict_types=1);
        function arraysSum(array ...$arrays): array
{
    return array_map(function(array $array): int {
        return array_sum($array);
    }, $arrays);
}

print_r(arraysSum([1,2,3], [4,5,6], [7,8,9]));
EOF;
echo nl2br($x);
try{
    
    function arraysSum(array ...$arrays):array
    {
        return array_map(function(array $array):int{
        
            return array_sum($array);
        },$arrays);
    }

    echo "<br/>";
    print_r(arraysSum([1,2,3], [4,5,6], [7,8,9]));
    



    
}catch(Throwable $t){
    echo "<br/> error is...<br/>";
    echo $t->getMessage();
    error_log($t->getMessage());
    throw $t;
}
