<?php
require_once '../php_code/library/config.php';

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
try{
$pdo = new PDO($dsn,DB_USER,DB_PWD,array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("SET CHARSET utf8");

$stmt = $pdo->prepare("CALL CountEmpBySalary(?,@count)");

$salary = 7000;
$stmt->bindParam(1,$salary,PDO::PARAM_STR );
$stmt->execute();

$stmt2 = $pdo->query("SELECT @count");
$row= $stmt2->fetch();

echo " Employee Having salary 7000 count: ".$row['@count'];
}catch(PDOException $ex){
    echo "Error! ".$ex->getMessage();
    die();
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

