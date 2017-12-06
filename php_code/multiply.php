<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$my_number1 = "";
$my_number2 = "";
if(count($_POST) > 0 ){
    $my_number1 = $_POST['input_number1'];
    $my_number2 = $_POST['input_number2'];
    
    if($my_number1 && $my_number2 && is_numeric($my_number1) && is_numeric($my_number2) ){     
                   $message_color = 'green'; 
                   $message = "$my_number1 * $my_number2 = ".($my_number1*$my_number2);
    }else{
        
        if(!is_numeric($my_number1)) $error_input_number1 = "Please enter valid number for multiplication";
        if(!is_numeric($my_number2)) $error_input_number2 = "Please enter valid number for multiplication";
        
        if(is_numeric($my_number1) && $my_number1 == 0) $error_input_number1 = "Number cannot be zero";
        if(is_numeric($my_number2) && $my_number2 == 0) $error_input_number2 = "Number cannot be zero";
        
      if(isset($error_input_number1))   $errors['input_number1'] = $error_input_number1 ;         
      if(isset($error_input_number2))   $errors['input_number2'] = $error_input_number2 ;
      
    }  
 
}
?>
<html>
    <head>
        <title>
            Multiply two numbers
        </title>
    </head>
    <body>
        <div style="text-align:center;padding-top:4em;padding-bottom:0.2em;font-weight:bold;color:<?php echo$message_color;?>;">
                        
                    </div>
        <div style="margin-left:20%;margin-right:20%;width:auto;text-align:center;border-style:solid;border-size:1px">
        <form method="POST" >
        <table align="center" valign="center" cellpadding="3" cellspacing="3" >
            <thead>
            <th colspan="2">
                Multiply two numbers
            </th>
            </thead>
            <tr>
                <td><label for="input_number"/>Enter a number</label></td>
                <td><input style="text-align:right;" type="text" id="input_number1" name="input_number1" value="<?php echo $my_number1;?>" size="5"/></td>
                <td style="color:red;font-weight:bold;"><?php if(isset($errors['input_number1'])) echo $errors['input_number1'] ?> </td>
            </tr>
            <tr>
                <td><label for="input_number"/>Enter an other number</label></td>
                <td><input style="text-align:right;" type="text" id="input_number2" name="input_number2" value="<?php echo $my_number2;?>" size="5"/></td>
                <td style="color:red;font-weight:bold;"><?php if(isset($errors['input_number2'])) echo $errors['input_number2'] ?></td>
            </tr>
            <tr>
                <td  colspan="2" style="text-align:right;font-size:2em;font-weight:bold;color:<?php echo$message_color;?>;">
                    
                        <?php if(isset($message)) echo $message ?>
                    
                </td>
                <td></td>
            </tr>
            <tr>
                <td><input type="submit" name="Submit" value="Submit" /></td>
                <td><input type="reset" name="cancel" value="cancel" /></td>
                <td></td>
            </tr>
        </table>
        </form>
        </div>
        </body>
</html>