<?php
/*
Configuration file
You need to change here your database authentication details
change corresponding value in sigle quotes . remeber dont use spaces in your values
*/

define('ERROR_REPORTING_VALUE',E_ALL & ~E_NOTICE);

error_reporting(ERROR_REPORTING_VALUE);


date_default_timezone_set("Asia/Calcutta");

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

$dsn_string = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;

define(DB_DSN,$dsn_string);



?>