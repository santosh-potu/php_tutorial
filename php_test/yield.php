<?php
function nums(){
    echo "the generator started<br/>";
    for($i=0;$i<5;$i++){
        yield $i;
        echo "Yielding $i<br/>";
    }
    
    echo " Generator has ended<br/>";
}

foreach (nums() as $v);

function nums2(){
    for($i=0;$i<5;$i++){
        $cmd = (yield $i);
        if($cmd == 'stop'){
            return;
        }
    }
}

$gen = nums2();

foreach($gen as $v){
    if($v == 3){
        $gen->send('stop');
    }
    echo "$v <br/>";
}