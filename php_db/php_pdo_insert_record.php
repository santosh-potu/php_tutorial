<?php
require_once '../php_code/library/config.php';

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
try{
$pdo = new PDO($dsn,DB_USER,DB_PWD,array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("SET CHARSET utf8");

echo "<table border=3>";
foreach($pdo->query("SELECT * FROM test") as $row){
        //print_r($row);
       echo " <tr><td>{$row['id']}</td><td>{$row['name']}</td>"
       . "<td>{$row['description']}</td><td>{$row['updated_at']}</td></tr>";
    }
echo "</table>";  

}catch(PDOException $ex){
    echo "Error! ".$ex->getMessage();
    die();
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

