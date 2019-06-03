<?php
require_once '../php_code/library/config.php';

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
try{
$pdo = new PDO($dsn,DB_USER,DB_PWD,array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("SET CHARSET utf8");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("UPDATE test SET name= ? , "
            . " description= ? WHERE  id = ?");
    $result_count = $stmt->execute([$_POST['name'],$_POST['desc'],$_POST['id']]);
    
    $pdo->commit();
    if($result_count){
        echo "Record saved";
    }else{
        echo 'Not saved';
    }
}
$stmt = $pdo->prepare("SELECT * FROM test WHERE  id = :id");
$stmt->execute(['id'=> $_GET['id']]);
$row = $stmt->fetch();

if($stmt->rowCount()){
    echo '<form method="post" > <table border=3 >';
    echo "<tr><td><label for='name'>Name</label></td>"
    . "<td><input id='name' name='name' value='{$row['name']}' required/>"
    . "<input type='hidden' name='id' id='id' value='{$row['id']}' /></td></tr>";
    echo "<tr><td><label for='desc'>Description</label></td>"
    . "<td><textarea rows='10' cols='20' id='desc' name='desc' required>"
            . "{$row['description']}</textarea></td>"
            . "</tr>";
    
    echo "<tr><td><input type='submit' value='Submit'/></td>"
    . "<td><input type='reset' value='Cancel'/></td>";
    echo '</tr></table></form>';
}
}catch(PDOException $ex){
    echo "Error! ".$ex->getMessage();
    $pdo->rollBack();
    die();
}






