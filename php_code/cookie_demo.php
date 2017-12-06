<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'library'.DIRECTORY_SEPARATOR.'config.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_REQUEST['language_selected'])){
    setcookie('my_language',  $_REQUEST['language_selected'],time()+3600);
    //header('Set-Cookie:my_language=3; expires=Tue, 16-Oct-2012 18:09:55 GMT');
    //header('Set-Cookie:my_language=3;');
    $selected_language = $_REQUEST['language_selected'];
}else if(isset($_COOKIE['my_language'])){
    $selected_language = $_COOKIE['my_language'];
}

$sql_query = "SELECT * FROM languages " ;

$rs = $mysqli->query($sql_query) or die($mysqli->error);

    
    while($row = $rs->fetch_array()){
        $languages[$row['language_id']] = $row['language'];
    }
    
if(isset($selected_language)){
    $display_param = 'display:none';
}else{
    $display_param = 'display:block';
}

$languages_query = "SELECT * FROM messages WHERE language_id = ? ";

$stmt_prepare = $mysqli->prepare($languages_query);

$selected_language = $selected_language?$selected_language:1 ;
$stmt_prepare->bind_param('i',$selected_language );
$stmt_prepare->execute();

$stmt_prepare->bind_result($message_id,$language_id,$message_key,$message);

    while($stmt_prepare->fetch()){
        
        define($message_key, $message);
    }
$stmt_prepare->close();
?>
<html>
    <head>
        <title>
            Cookie Demo 
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript">
            
          function submitToServer(){
              var language_selected = document.getElementById('language_selected').value;
              location.href='cookie_demo.php?my_language='+language_selected;
          }
          function showLanguageOption(){
              document.getElementById('language_div').style.display = 'block';
              document.getElementById('message_div').style.display = 'none';
              
          }
        </script>
        <style>
            body{
                font-family: arial,serif;
                font-size:1.5em;
            }
        </style>
    </head>
    <body>
     <div id="message_div" style="margin:8%;width:80%;text-align:center;">
         <?php echo MESSAGE_SITE_UNDER_DEVELOPMENT; ?> <a href="#" onclick="return showLanguageOption();"><?php echo MESSAGE_CLICK_HERE; ?></a>
     </div>    
        <div id='language_div'  style="margin:10%;width:70%;text-align:center;<?php echo $display_param ?>" >
            <br/>
            <span>
                 <?php echo MESSAGE_SELECT_A_LANGUAGE?>
           </span>
            <span>
                <form method="POST">   
            <select  onchange="this.form.submit();" name="language_selected" id="language_selected">
            <?php
              foreach($languages as $language_id => $language_name){
                  if(isset($selected_language) && $selected_language == $language_id){
                        $slected_string = 'selected ="true"';
                    }else{
                        $slected_string = '';
                    }
                echo "<option $slected_string value='$language_id'>$language_name</option>";            
              }
            ?>
        </select>
                </form>            
        </span>
        </div>
       
    <script type="text/javascript">
            <?php if(!isset($selected_language)){
                echo "document.getElementById('message_div').style.display = 'none';";
            }
            ?>
        </script>    
    </body>
    
</html>
