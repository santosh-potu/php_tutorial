<?php
date_default_timezone_set('Asia/Kolkata');
echo date('M j Y g:i A', strtotime('2010-05-29 01:17:35'));

echo "<br/>date_default_timezone_set('Asia/Kolkata');<br/>";
echo "<br/>Conveting MySQL time stamp to date <br/>";
echo "date('M j Y g:i A', strtotime('2010-05-29 01:17:35'));";

$dt = new DateTime('2010-05-29 01:17:35');
echo $dt->format('M j Y g:i A');

echo '<br/>$dt = new DateTime("2010-05-29 01:17:35");<br/>'.
     '$dt->format("M j Y g:i A");'.
      '<br/>$dt->setTimezone(new DateTimeZone("Asia/Kolkata")); /Not required as we already set';  

$dt = new DateTime();
//$dt->setTimezone(new DateTimeZone("Asia/Kolkata")); //Not required as we already set
echo "<br/>Time now ".$dt->format("M j Y g:i A")

?>