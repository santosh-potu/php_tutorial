<?php
   require_once('header.php');
   
   $sql ="insert into employee(name,age,dept_id,last_updated) values(?,?,?,now() )";
   $stmt = $pdo->prepare($sql);
   $stmt->bindValue(1,$_POST['name']);
   $stmt->bindValue(2,$_POST['age']);
   $stmt->bindValue(3,$_POST['dept'],PDO::PARAM_INT);
   $stmt->execute();
   $stmt->rowCount();
   
/*   $params = array(1, 21, 63, 171);
// Create a string for the parameter placeholders filled to the number of params 
$place_holders = implode(',', array_fill(0, count($params), '?'));

    This prepares the statement with enough unnamed placeholders for every value
    in our $params array. The values of the $params array are then bound to the
    placeholders in the prepared statement when the statement is executed.
    This is not the same thing as using PDOStatement::bindParam() since this
    requires a reference to the variable. PDOStatement::execute() only binds
    by value instead.

$sth = $dbh->prepare("SELECT id, name FROM contacts WHERE id IN ($place_holders)");
$sth->execute($params);
*/
                   
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php           
            include("table.php");
        ?>
    </body>
</html>

