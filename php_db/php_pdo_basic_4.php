<?php
require_once '../php_code/library/config.php';

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
try{
$pdo = new PDO($dsn,DB_USER,DB_PWD,array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("SET CHARSET utf8");

$stmt = $pdo->query("SELECT * FROM test");

if($stmt->rowCount()){
    echo '<table border=3 >';
    echo "<tr>";
          for($i=0; $i<$stmt->columnCount();$i++){
             echo "<th>".ucfirst($stmt->getColumnMeta($i)['name'])."</th>";
          }
    echo "</tr>";
    $result = $stmt->fetchAll();
    foreach($result as $row ){
        //print_r($row);
       echo " <tr><td>{$row['id']}</td><td>{$row['name']}</td>"
       . "<td>{$row['description']}</td><td>{$row['updated_at']}</td></tr>";
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

