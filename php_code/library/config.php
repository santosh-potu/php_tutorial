<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors','On');

session_start();

if($_SERVER["SERVER_NAME"] != 'localhost'){
    define(DB_HOST,'mysql1.000webhost.com');
    define(DB_USER,'a4832129_spotu16');
    define(DB_PWD,'psreddy82');
    define(DB_NAME,'a4832129_spotu16');
}else{
    define(DB_HOST,'localhost');
    define(DB_USER,'root');
    define(DB_PWD,'root');
    define(DB_NAME,'php_tutorial');
}
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);

if ($mysqli->connect_errno) {
    echo "Failed to connect to Database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->set_charset('utf8');




function enroll_hit(){
         
         global $mysqli;
         
         
         $ip_address = $_SERVER["REMOTE_ADDR"]; 
         $user_agent = $mysqli->real_escape_string($_SERVER["HTTP_USER_AGENT"]);
         $session_id = session_id();
         
         $session_timeout = ini_get("session.gc_maxlifetime");
         
         
         $hits_query = "UPDATE ip_hits SET user_agent = '$user_agent'  , ".
                       " hits = hits + 1 , access_time = NOW() ".
            " WHERE ip_address = '$ip_address' AND session_id = '$session_id' AND DATEDIFF(NOW(),access_time) < 1 ";
         
         $result = $mysqli->query($hits_query) or die($hits_query." -- ".$mysqli->error);
         $num_rows = $mysqli->affected_rows;
         
         if(!$num_rows){
             
             $hits_query = "INSERT INTO ip_hits SET session_id = '$session_id' ,"
                     . " user_agent = '$user_agent' , access_time = NOW(), "
                     . " ip_address = '$ip_address' ON DUPLICATE KEY UPDATE hits = hits +1 ";    
             
             $mysqli->query($hits_query) or die($hits_query." -- ".$mysqli->error);
         }
     }            

     enroll_hit(); 

?>
