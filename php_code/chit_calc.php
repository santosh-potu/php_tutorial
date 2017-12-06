<?php

/* 
 * 
 * 
 * 
 */

$chit_amount = 500000;
$duration = 24;
$final_amount = 470000;
$num_years = 2;

$bank_interest_rate = ($_GET['interest']?$_GET['interest']:7)/100;

$payments = array(14800,
                    15560,
                    15780,
    15760,
    15380,
    15540,
    15920,
    16360,
    16200,
    16760,
    16960,
    17400,
    17900,
    18740,
    18760,
    18840,
    18800,
    19160,
    19320,
    19380,
    19520,
    19620,
    19840,
    19960);
$profit_emi = array();
$amount_paid = 0;

$frequency = 4;

foreach($payments as $emi){
    $amount_paid = $amount_paid + $emi;
}
?>
<table border="2" align="center" cellspacing="3" cellpadding="3">
    <thead>
    <th>EMI paid</th>
    <th>After profit</th>
    <th>profit</th>
    <th>%</th>
    <th>CAGR</th>
    <th>Bank Interest</th>
    </thead>
<?php
$final_am = 0;
$total_cagr = 0;
$total_amount_bank = 0;

for($i=0; $i < count($payments);$i++){
    $profit_emi[$i] = round($final_amount * $payments[$i]/$amount_paid);
    $final_am = $final_am + $profit_emi[$i];
    $tmp_profit = $profit_emi[$i]-$payments[$i];
    $tmp_profit_percent = round($tmp_profit * 100 / $profit_emi[$i]);
    $tmp_n = 1 / (($duration-$i)/12);
    $tmp_cagr = pow( ($profit_emi[$i]/$payments[$i]) , $tmp_n) - 1 ;
    $tmp_cagr = $tmp_cagr * 100;
    $tmp_power_ci = $frequency * (($duration-$i)/12);
    
    $tmp_bank_interest = $payments[$i] * pow( (1 + ($bank_interest_rate/$frequency)) ,
            $tmp_power_ci );
    $tmp_bank_interest = round($tmp_bank_interest); 
    
    $total_amount_bank = $total_amount_bank + $tmp_bank_interest ;
    
    echo "<tr><td>{$payments[$i]}</td><td>{$profit_emi[$i]}</td>"
    . "    <td>{$tmp_profit}</td>"
            . "<td>{$tmp_profit_percent}%</td>"
            . "<td>$tmp_cagr</td>"
                    . "<td>$tmp_bank_interest </td></tr>";
            $total_cagr = $total_cagr + $tmp_cagr;
            
}
$total_cagr = $total_cagr /count($payments);
echo "</table>";
echo "<br/>Final Amount $final_am - Actual Amount Paid $amount_paid";
echo "<br/> Total Amount with Bank interest $total_amount_bank ";
echo "<br/>Final CAGR $total_cagr";
?>