<?php

require_once 'config.php';


//mysql connection related
try{
    $pdo = new PDO(DB_DSN, DB_USER,DB_PWD);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
} catch (Exception $ex) {
    die('unable to connect database :'.$ex->getMessage());
}
//mysql_connect(DB_HOST,DB_USER,DB_PWD) or die(mysql_error()); //die("Cannot Connetct");
//mysql_select_db(DB_NAME) or die(mysql_error());// "no access To Database"
?>
