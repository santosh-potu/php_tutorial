<html>
    
    <head>
        <title>
          Arrays Demo  
        </title>
    </head>
    <body>   
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$demo_array = array(); //optional but good programming
// $demo_array = array(1,2,3,4,5); optional
for($i=0; $i<10;$i++){
    $demo_array[] = $i + 1;
}
echo "<b> Array of numbers</b><br/>";
for($i=0; $i<10;$i++){
    echo $demo_array[$i]."<br/>";
}
$demo_keypair_array = array('PrimeMinster' => 'manmohan',
                            'HomeMinister' => 'Shinde',
                            'FinanceMinister' => 'PC',
                            'EnironmentalMiinster' => 'Jayanthi',
                            'HumanresourcesMinister' => 'Sibal');

echo "<b> List Of Ministers with their portfolio</b><br/>";
foreach($demo_keypair_array as $key => $value){
    echo $key ." - ". $value."<br/>";
}
echo "<b> List Of Ministers</b><br/>";
foreach($demo_keypair_array as  $value){
    echo  $value."<br/>";
}
?>
    </body>
</html>