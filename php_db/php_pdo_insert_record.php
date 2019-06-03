<?php
require_once '../php_code/library/config.php';

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
try{
$pdo = new PDO($dsn,DB_USER,DB_PWD,array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("SET CHARSET utf8");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO test SET name= :name , "
            . " description= :desc ");
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindValue(':desc', $_POST['desc']);
    $result_count = $stmt->execute();
    
    $pdo->commit();
    if($result_count){
        echo "Record saved. <a href='php_pdo_basic.php'>Click here</a>";
        exit();
        
    }else{
        echo 'Not saved';
    }
}


    echo '<form method="post" > <table border=3 >';
    echo "<tr><td><label for='name'>Name</label></td>"
    . "<td><input id='name' name='name' value='{$_POST['name']}' required/>"
    . "</td></tr>";
    echo "<tr><td><label for='desc'>Description</label></td>"
    . "<td><textarea rows='10' cols='20' id='desc' name='desc' required>"
            . "{$_POST['description']}</textarea></td>"
            . "</tr>";
    
    echo "<tr><td><input type='submit' value='Submit'/></td>"
    . "<td><input type='reset' value='Cancel'/></td>";
    echo '</tr></table></form>';

}catch(PDOException $ex){
    echo "Error! ".$ex->getMessage();
    $pdo->rollBack();
    die();
}






