<?php
error_reporting(0);
//if(!empty($_POST)){ or isset($_POST)
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result = 0;
    
    if(!is_dir(dirname(__FILE__).'/uploads')){
        mkdir(dirname(__FILE__).'/uploads');
    }
   
    if(count($_FILES['my_file']['name']) > 1 ){ 
        
        
        for($i=0; $i< count($_FILES['my_file']['name']);$i++){
           if($_FILES['my_file']['error'][$i] != UPLOAD_ERR_NO_FILE ){ // 4 = UPLOAD_ERR_NO_FILE
               $destination = dirname(__FILE__).'/uploads/'.$_FILES['my_file']['name'][$i]; 
               $result = @move_uploaded_file($_FILES['my_file']['tmp_name'][$i], $destination);
               $file_upload_message .= " {$_FILES['my_file']['name'][$i]},";
            }
        }
    }else{
        $destination = dirname(__FILE__).'/uploads/'.$_FILES['my_file']['name'];
        $result = @move_uploaded_file($_FILES['my_file']['tmp_name'], $destination);
        $file_upload_message = " {$_FILES['my_file']['name']}";
    }
    
    if(!$result) {
        $file_upload_message = " There is some error hence ".rtrim($file_upload_message,',')."file(s) not uploaded!" ;
    }else{
        $file_upload_message = rtrim($file_upload_message,',')." Successfully uploaded!";
    }
    
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>
            Files Demo
        </title>
    </head>
    <body>
          <?php if($file_upload_message) { ?>
        <table>
                <tr>
                    <td colspan="2" style="color:<?php  echo (substr_count($file_upload_message,'error'))?'red':'green';?>;">
                        <?php echo '<strong>'.$file_upload_message.'</strong>' ?>
                        
                    </td>
                </tr>
        </table>        
                <?php } ?>
        <form id="single_file" method="POST" enctype="multipart/form-data">
            <table border ="3">
              
                <tr>
                    <td>
                        Upload
                    </td>
                    <td>
                        <input type="file" name="my_file" />
                    </td>
                </tr>
                <tr>
                    <td>
                         <input type="submit" name="submit" value="Submit" />
                    </td>
                    <td>
                        <input type="reset"  value="Cancel" />
                    </td>
                </tr>
            </table>
            
            
        </form>
        
        <form id="single_file" method="POST" enctype="multipart/form-data">
            <table border="1">
                <tr>
                    <td>
                        Upload Multiple Files - File1
                    </td>
                    <td>
                        <input type="file" name="my_file[]" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Upload Multiple Files - File2
                    </td>
                    <td>
                        <input type="file" name="my_file[]" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Upload Multiple Files - File3
                    </td>
                    <td>
                        <input type="file" name="my_file[]" />
                    </td>
                </tr>
                <tr>
                    <td>
                         <input type="submit" name="submit" value="Submit" />
                    </td>
                    <td>
                        <input type="reset"  value="Cancel" />
                    </td>
                </tr>
            </table>
            
            
        </form>
        
    </body>
</html>    
