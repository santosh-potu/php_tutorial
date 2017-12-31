<?php
$errors = $args['errors'];
?>
<form action="login/Authenticate" method="post">
    <table>
        <?php if ($errors) {
            foreach($errors as $error){
            echo "<tr><td colspan='2'>$error</td></tr>";
            }
        }
        ?>
            
        </tr>
        <tr>
            <td><label for="user_name">Login</label></td>
            <td><input required="true" type="text" id="user_name" name="user_name"/></td>
        </tr>
        <tr>
            <td><label for="pwd">Password</label></td>
            <td><input  required="true" type="password" id="pwd" name="pwd"/></td>
        </tr>
        <tr>
            <td><input type="submit"value="submit"/></td>
            <td><input type="reset" value="cancel"/></td>
        </tr>
    </table>  
</form>
