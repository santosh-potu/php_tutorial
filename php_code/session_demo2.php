<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'library'.DIRECTORY_SEPARATOR.'config.php';
session_start();
if($_REQUEST['action'] == 'logout'){
        //session_destroy();
       
        unset($_SESSION['user_logged']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        
        setcookie('user_name','',time()-100);
        setcookie('pwd','',-1);
        echo 'To Login <a href="'.$_SERVER['PHP_SELF'].'">Click here</a>';
        exit;
    }
    
if(!isset($_SESSION['user_id']) && ( isset($_COOKIE['user_name'] )&&isset($_COOKIE['pwd'] )) ){
   $_REQUEST['action'] = 'login';
   $_REQUEST['from_cookie'] = 1;
   $_REQUEST['user_name'] = $_COOKIE['user_name'];
   $_REQUEST['pwd'] = $_COOKIE['pwd'];
}
if($_REQUEST['action'] == 'login'  ){
    
  if(strlen(trim($_REQUEST['user_name'])) == 0){
      $errors[] = '* User name cannot left be empty'; 
  }
  if(strlen(trim($_REQUEST['pwd'])) == 0){
      $errors[] = '* Password cannot left be empty'; 
  }
  extract($_REQUEST);
  
  
  if(!count($errors)){
      $login_query = "SELECT * FROM users WHERE user_name = ?  
          AND pwd = MD5(?) ";
      if($_REQUEST['from_cookie']){
          $login_query = "SELECT * FROM users WHERE user_name = ? 
          AND pwd = ? ";
          
      }
      
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($login_query);
      
      
      $stmt->bind_param('ss',$user_name,$pwd);
      
      
      $stmt->execute() or die($stmt->error);
      $rs = $stmt->get_result();
      
      
      
      if($stmt->affected_rows ){
          
        $user_record = $rs->fetch_array();
        
            if($user_record){
                
                $_SESSION['user_id'] = $user_record['user_id'];
                $_SESSION['user_name'] = $user_record['user_name'];
                $_SESSION['user_logged'] = TRUE ;
               
                if($_REQUEST['remember_me'] == '1'){
                    setcookie('user_name',$user_name,time()+3600);
                    setcookie('pwd',md5($pwd),time()+3600);
                }
            }
      }else{
          $errors[] = 'Invalid user name or password';
      }
      
  }
}
    

?>
<html>
    <head>
        <title>Session Demo</title>
    </head>
    <body>
        <div style="margin-left:50%;margin-top:10%">
         <?php if (!$_SESSION['user_logged']) 
             
         {
             
         ?>   
            <form method="POST">
                <table border="3">
                    <tr>
                        <td align="center" colspan="2">Enter Login Details</td>
                       
                    </tr>
                    <tr>
                        <td colspan="2" style="color:red;">
                            <?php 
                            if(count($errors) > 0){
                                foreach($errors as $error){
                                echo $error.'<br/>';
                                }
                            }
                            ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>User name</td>
                        <td><input name="user_name" id="user_name" type="text" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input name="pwd" id="pwd" type="password" />
                            <input name="action" id="action" type="hidden" value="login"/>                      
                        </td>
                    </tr>
                    <tr>
                        <td><input name="submit" id="submit" value="Submit" type="submit" /></td>
                        <td><input name="cancel" id="cancel" value='Cancel' type="reset" /></td>
                    </tr>
                      <tr>
                        <td>Remember Me</td>
                        <td><input name="remember_me" id="remember_me" type="checkbox" value="1" /></td>
                    </tr>
                </table>
                
            </form>
         <?php }else{ ?>
            Thank you  '<?php echo $_SESSION['user_name'].'!';?> ' - for logging .To logout <?php echo "<a href='?action=logout'>Click here</a>"?>  
          <?php } ?>  
        </div>    
    </body>
</html>
