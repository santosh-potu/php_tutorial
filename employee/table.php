<?php

require_once('header.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Employee Information System - Employee List</title>
    </head>
    <body>
        <?php
        
         $sql ="SELECT * FROM employee e INNER JOIN departments d 
             ON e.dept_id = d.dept_id";
        try{
            $stmt = $pdo->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $stmt->execute();
           // $stmt->fetchAll();
        } catch (Exception $ex) {

        }
        ?>
        <center>
        <h2 style="color:blue;font-family:arial;">Employee Details</h2>
        <table    bgcolor="aqua" cellspacing="10px"
        style="font:arial;color:black;width:50%;font-size:16px;">
            <thead>
            <tr style="font-size:18px;">
            <th>Name</th>
            <th>Id</th>
            <th>Age</th>
            <th>Department</th>
            <th>Last Updated</th>
            </tr>
            </thead>
            <tbody><a href="http://update.php" onclick=""></a>
         <?php
        
             foreach($stmt as $arr){
                 
                 $last_updated = date('d-m-Y g:i:s A',strtotime($arr['last_updated']));
                    print "<tr ".$clorString ."><td id=td>";
                    echo $arr['name'];
                    print "</td><td>";
                    echo $arr['id'];
                    print "</td><td>";
                    echo $arr['age'];
                    print "</td><td>";
                    echo $arr['department_name'];
                    print '</td><td>'.$last_updated;
                    echo "</td>";
                    echo '<td><a href="update.php?id='.$arr['id'].
                       '" onClick="return check()">Edit/Delete</a></td></tr>';
             }

 ?>
         </tbody>
            </table>
            </center>
    </body>
</html>
<script type="text/javascript">
    function check()
    {
    var r=confirm("Are You want to Edit/Delete The Record");
  if (r==true)  return true;
        else    return false;
    }
    </script>
