<?php
session_start();

define('ENV','dev');
require_once __DIR__.DIRECTORY_SEPARATOR.ENV.'.php';

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
            " WHERE ip_address = '$ip_address' AND session_id = '$session_id' AND DATEDIFF(NOW(),access_time) >= 1 ";
         
         $result = $mysqli->query($hits_query) or die($hits_query." -- ".$mysqli->error);
         $num_rows = $mysqli->affected_rows;
         
         if(!$num_rows){
             
             $hits_query = "INSERT INTO ip_hits SET session_id = '$session_id' ,"
                     . " user_agent = '$user_agent' , access_time = NOW(), "
                     . " ip_address = '$ip_address' ON DUPLICATE KEY UPDATE "
                     . " session_id = '$session_id'  ";    
             
             $mysqli->query($hits_query) or die($hits_query." -- ".$mysqli->error);
         }
     }            

     enroll_hit(); 

?>
