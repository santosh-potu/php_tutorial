<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(count($_POST) > 0 ){
    $my_number = $_POST['input_number'];
    if(is_numeric($my_number)){
        ($my_number % 2 == 0 )? $even_number = 1 : $even_number = 0;
    }    

if(isset($even_number)){
                   $message_color = 'green';
                    if($even_number){
                        $message= "$my_number is Even number";
                    }else{
                       $message ="$my_number is odd number";
                    }   
                
}else{
    $message = "Please enter a valid Number";
    $message_color = 'red';
}           
}
?>
<html>
    <head>
        <title>
            Find a number is even or not
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
                Find a number is even or odd
            </th>
            </thead>
            <tr>
                <td><label for="input_number"/>Enter a number</label></td>
                <td><input type="text" id="input_number" name="input_number" size="5"/></td>
            </tr>
            <tr>
                <td><input type="submit" name="Submit" value="Submit" /></td>
                <td><input type="reset" name="cancel" value="cancel" /></td>
            </tr>
        </table>
        </form>
        </body>
</html>