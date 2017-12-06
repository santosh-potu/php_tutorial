<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(count($_POST) > 0 ){
    $my_number1 = $_POST['input_number1'];
    $my_number2 = $_POST['input_number2'];
    
    if(is_numeric($my_number1) && is_numeric($my_number2) && 
            (($my_number2 - $my_number1) > 0)){     
                   $message_color = 'green'; 
                   $numbers_text= "";
                   for($i=$my_number1;$i<= $my_number2;$i++){
                       $numbers_text.="<tr><td>$i</td></tr>";
                   }
                   $message = <<<EOT
                           <table align="center" cellpadding="3" cellspacing="3" border=3">
                           <thead>
                           <th>Numbers between $my_number1 - $my_number2</th>
                           </thead>
                           <tbody>
                           $numbers_text;
                           </tbody>
                           </table>
                           
EOT;
    }else{
        $message = "Please enter a valid numerical range";
        $message_color = 'red';
    }           
}
?>
<html>
    <head>
        <title>
            Print the numbers in a range
        </title>
    </head>
    <body>
        <div style="text-align:center;padding-top:4em;padding-bottom:0.2em;font-weight:bold;color:<?php echo$message_color;?>;">
                <?php if(isset($message)) echo $message ?>
        </div>
        <form method="POST" >
        <table align="center" valign="center" cellpadding="3" cellspacing="3" border="2">
            <thead>
            <th colspan="2">
                Print the numbers in a range
            </th>
            </thead>
            <tr>
                <td><label for="input_number"/>Enter a number for lower limit</label></td>
                <td><input type="text" id="input_number1" name="input_number1" size="5"/></td>
            </tr>
            <tr>
                <td><label for="input_number"/>Enter a number for Upper limit</label></td>
                <td><input type="text" id="input_number2" name="input_number2" size="5"/></td>
            </tr>
            <tr>
                <td><input type="submit" name="Submit" value="Submit" /></td>
                <td><input type="reset" name="cancel" value="cancel" /></td>
            </tr>
        </table>
        </form>
        </body>
</html>