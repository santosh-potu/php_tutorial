<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    extract($_POST);
    
}
?>
<html>
    <head>
        <title>
            Forms Demo
        </title>
    </head>
    <body>
        <table align="center" width="40%" border="3">
            <tr>
                <td>Request Method</td>
                <td><b><?php echo $_SERVER['REQUEST_METHOD'] ?></b></td>
            </tr>
            <tr>
                <td>Content-Type</td>
                <td><b><?php echo $_SERVER['CONTENT_TYPE']; ?></b></td>
            </tr>
        </table>
        <table align="center" width="40%" border="3" >
            <tr>
                <td>
                    <form method="GET" enctype="application/x-www-form-urlencoded">
                        <table  border="3">
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" value="<?php echo $_GET['name']; ?>" /></td>
                            <!--   echo $_REQUEST['name'];       -->
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit"  value="GET form submit"/>
                                </td>
                            </tr>
                        </table>
                        
                    </form>
                </td>
            </tr>
               <tr>
                <td>
                    <form method="POST" enctype="multipart/form-data">
                        <table align="center"  border="3">
                            <tr>
                                <td>Name(multipart/form-data)</td>
                                <td><input type="text" name="name" value="<?php echo $name; ?>" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="submit" value="POST form submit"/>
                                </td>
                            </tr>
                        </table>
                        
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form method="POST" enctype="application/x-www-form-urlencoded">
                        <table align="center"  border="3">
                            <tr>
                                <td>Name(application/x-www-form-urlencoded)</td>
                                <td><input type="text" name="name" value="<?php echo $_POST['name']; ?>" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="submit" value="POST form submit"/>
                                </td>
                            </tr>
                        </table>
                        
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form method="POST" enctype="text/plain">
                        <table>
                            <tr>
                                <td>Name(text/plain)</td>
                                <td><input type="text" name="name" value="Sample Text santosh.php6@gmail.com" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="submit" value="POST form submit"/>
                                </td>
                            </tr>
                        </table>
                        
                    </form>
                </td>
            </tr>
        
        </table>
        <table align="center" width="40%" border="3" >
  <tbody>
      <tr>
    <td colspan="2" align="center">Form attribute <strong>enctype</strong> Values</td>
  </tr>  
      <tr>
    <th width="40%" align="left">Value</th>
    <th width="60%" align="left">Description</th>
  </tr>  
  <tr>
    <td>application/x-www-form-urlencoded</td>
    <td>Default. All characters are encoded before sent (spaces are converted to 
	"+" symbols, and special characters are converted to ASCII HEX values)</td>
  </tr>
  <tr>
    <td>multipart/form-data</td>
    <td>No characters are encoded. This value is required when you are using 
	forms that have a file upload control</td>
  </tr>
  <tr>
    <td>text/plain</td>
    <td>Spaces are converted to "+" symbols, but no special characters are encoded</td>
  </tr>
  </tbody></table>
    </body>
</html>