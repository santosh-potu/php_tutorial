<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors','On');

session_start();

@define(DB_HOST,'localhost');
@define(DB_USER,'root');
@define(DB_PWD,'');
@define(DB_NAME,'php_tutorial');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);

if ($mysqli->connect_errno) {
    echo "Failed to connect to Database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->set_charset('utf8');




function enroll_hit(){
         
         global $mysqli;
         
         $customer_id = $_SESSION['customer_id'];
         $ip_address = $_SERVER["REMOTE_ADDR"]; 
         $user_agent = $mysqli->real_escape_string($_SERVER["HTTP_USER_AGENT"]);
         $session_id = session_id();
         
         $session_timeout = ini_get("session.gc_maxlifetime");
         $customer_id = 1;
         
         $hits_query = "UPDATE ip_hits SET session_id = '$session_id' , 
             user_agent = '$user_agent' , customer_id = '$customer_id' ,
                 hits = hits + 1 , access_time = NOW()
             WHERE ip_address = '$ip_address' AND DATEDIFF(NOW(),access_time) < 1 ";
         
         $result = $mysqli->query($hits_query) or die($hits_query." -- ".$mysqli->error);
         $num_rows = $mysqli->affected_rows;
         
         if(!$num_rows){
             
             $hits_query = "INSERT INTO ip_hits SET session_id = '$session_id' , 
             user_agent = '$user_agent' , access_time = NOW(), customer_id = '$customer_id',
             ip_address = '$ip_address' ";    
             
             $mysqli->query($hits_query) or die($hits_query." -- ".$mysqli->error);
         }
     }            

     enroll_hit(); 

?>
