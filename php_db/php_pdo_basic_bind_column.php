<?php
require_once '../php_code/library/config.php';

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
try{
$pdo = new PDO($dsn,DB_USER,DB_PWD,array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("SET CHARSET utf8");

$stmt = $pdo->prepare("SELECT * FROM test");
$stmt->execute();

if($stmt->rowCount()){
    $stmt->bindColumn(1, $id);
    $stmt->bindColumn('name', $name);
    $stmt->bindColumn('description', $desc);
    $stmt->bindColumn(4, $updated_at);
    
    echo '<table border=3 >';
    echo "<tr>";
          for($i=0; $i<$stmt->columnCount();$i++){
             echo "<th>".ucfirst($stmt->getColumnMeta($i)['name'])."</th>";
          }
    echo "<th><a href='php_pdo_insert_record.php'> Insert Record</a></th></tr>";
    while($row = $stmt->fetch()){
        //print_r($row);
       echo " <tr><td>{$id}</td><td>{$name}</td>"
       . "<td>{$desc}</td><td>{$updated_at}</td>"
       . "<td><a href='php_pdo_edit_record.php?id={$id}'>Edit</a></td></tr>";
    }
    echo '</table>';
}
}catch(PDOException $ex){
    echo "Error! ".$ex->getMessage();
    die();
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

