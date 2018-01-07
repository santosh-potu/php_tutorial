<?php
echo "Factorial of 9 is ".factorial(9);

function factorial($num):int{
    echo " $num <br/>\n";
    if($num>1){
        return $num * factorial($num -1);
    }
    
    return 1;
}
?>