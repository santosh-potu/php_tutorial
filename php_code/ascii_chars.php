<?php

$ascii_chars = array();

	for($i=ord('A');$i<=ord('z');$i++){
	$ascii_chars[chr($i)]=$i;
	}


$last_key = @end(array_keys($ascii_chars));
$my_text ="<tr>";
$i=0;
$table_columns = 5;
	foreach($ascii_chars as $key => $value){
		$my_text .= "<td><strong>$key</strong> => $value</td>";
		if($key == $last_key){
			  $my_text.= "<td colspan='".($i%$table_columns)."'>&nbsp;</td></tr>\n";
			  break;
		}
		if( ++$i % $table_columns == 0  ){
			$my_text.= "</tr>\n";
		}
	}

?>
<html>
	<head>
		<title>Ascii characters and their codes</title>
	</head>
	<body>
		<table border="2" align="center" cellspacing="3" cellpadding="3">
			 <thead>
				<th colspan="10">Ascii Characters & their Values</th>
			 </thead>
			 <tbody>
			 <?php echo $my_text ?>
			 </tbody>
		</table>
	</body>
</html>
