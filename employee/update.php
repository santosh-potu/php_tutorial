<?php
 require_once('header.php');
 
   function display($msg){
     ?>
<fieldset><legend style="font-size:20px;"><?php echo $msg ?></legend>
  <h3>  To View Latest Employee Information</h3><br>
  <a href="table.php"><h2 style="color:blue;font-style:oblique;"> Click here</h2>
  </a>
</fieldset>
<?php
    }

    ?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
           
            
            if(!empty($_POST))
            {
                switch($_POST['submit'])
                {
                    case 'Update':
                    $sql="update employee set name = ?,age= ?,dept_id= ? ,last_updated = ? where id= ? ";
                    //echo $sql;
                        try{
                            $stmt = $pdo->prepare($sql);
                            $date = date('Y-m-d H:i:s');
                            
                            $stmt->execute(array($_POST['name'],$_POST['age'], $_POST['dept'],$date,$_POST['id']));
                            
                            $rowCount = $stmt->rowCount();
                        } catch (Exception $ex) {
                            echo $ex->getMessage();
                            exit;
                        }
               
                    display("Employee havaing Id ->".$_POST['id'].", Updated SucessFully. row Count:$rowCount");
                    break;
                    case 'Delete':
                    $sql ="delete from employee where id= ".$pdo->quote($_POST['id']);
                    $rowCount = $pdo->exec($sql);
                    display("Employee havaing Id->".$_POST['id']."Deleted SucessFully .Row Count:$rowCount");
                    break;
                    default:
                    $pdo = NULL;
                }
            }
        ?>
        <?php
            include_once("Employee.php");
            if(!empty($_GET)){
                $sql ="select * from employee where id = :id ";
                // echo $sql;
                    try{
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(':id'=> $_GET['id']));
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                        exit;
                    }    
                    
       
        $obj =  $stmt->fetchObject();
        
        $sql ="select dept_id,department_name from departments ";
        try{
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                        exit;
                    }
                    
        $deptArr=array();
        while ($dept    =  $stmt->fetch(PDO::FETCH_ASSOC)){
            $deptArr[$dept['dept_id']]=$dept['department_name'];
        }  
       ?>

        <form name="main" action="update.php" method="POST"
        onsubmit="return validate()"enctype="multipart/form-data">
        <table border="2" >
<thead>
<tbody>
<tr>
<th>ID </th>
<td><input type="text" name="id" value="<?php  echo $obj->id;?>" size="35" readonly="readonly" /></td>
</tr>
<tr>
<th>Name </th>
<td><input type="text" id="name" name="name" value="<?php echo $obj->name;?>"
  onkeyPress="return checkName(event)"       size="35" /></td>
</tr>
<tr>
<th>Age</th>
<td><input type="text" name="age" value="<?php   echo $obj->age;?>" size="3"
onkeyPress="return doMagic(event)" /></td>
</tr>
<tr>
<th>Department</th>
<td><select name="dept">

<?php

    
    
    foreach($deptArr as $key => $value)  {         
     if($key == $obj->dept_id ) {
         $selectString=" selected='selected' ";
     }else{
         $selectString = "";
     }
     echo "<option value='$key' $selectString>$value</option>";    
    }
    ?>
</select></td>

</tr>
<tr>
<td><input type="submit" value="Update" name="submit" />
<input type="submit" value="Delete" name="submit" /></td>
<td><input type="reset" value="Cancel" name="cancel" onclick="javascript:location.href='table.php';" /></td>
</tr>
</tbody>
</table>
        </form>
    </body>
</html>
<?php
    }
    ?>
    <Script type="text/javascript">
function validate()
{
	var name=document.getElementById("name").value;
        var age =document.getElementById("age").value;

       if(name==null||name=="")
	{
	alert("Please Enter Employee Name");
	return false;
	}


	if(!checkValue()) { return false;}
	return true;
}

function doMagic(e)
{


var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e.which) keycode = e.which;

//var keychar = String.fromCharCode(keynum);

if(( keycode < 48   || keycode > 57) && keycode!=46 && keycode!=8)
	{ alert("Enter Numeric Value ");e.returnValue=false;e.preventDefault(true);}

}
function checkName(e)
{


var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e.which) keycode = e.which;

//var keychar = String.fromCharCode(keynum);

if(( keycode < 48   || keycode > 57)  )
	e.returnValue=true;
else
	{ e.returnValue=false; e.preventDefault(true);}

}
function checkValue()
{
	var tmp=0;
	var x=0;
	var y=true;
	var errmsg="Please Enter Value For '";

        if(document.getElementById("age").value.length==0)
{ y=false;errmsg=errmsg+document.getElementById("age").name+"'";}
		else
		tmp=parseInt(document.getElementById("age").value);

		if(tmp > 100 || tmp < 0)
		{
		x++;
		document.getElementById("age").focus();
		document.getElementById("age").select();
		}



	if(y==false) {  alert(errmsg);return false;}

	if(x > 0) {alert("Age Must Be > 0 & <100");return false;}

          return true;
}
</script>

