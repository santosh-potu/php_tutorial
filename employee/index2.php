<?php

require_once 'header.php';


 $sql ="select dept_id,department_name from departments ";
 
 try{
     $stmt = $pdo->query($sql);
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
 } catch (Exception $ex) {
     echo $ex->getMessage();
     exit ;
 }
 
 
 $deptArr=array();
 //$stmt->fetch(); //PDO::FETCH_ASSOC
 foreach($stmt as $dept){
    $deptArr[$dept['dept_id']]=$dept['department_name'];
 }       
 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Employee Information System</title>
    </head>
    <body>
    <center>
    <h2> Enter The New Employee Details</h2><hr>
    <form name="main" action="addtotable.php"
    onsubmit="return validate()" method="POST" enctype="multipart/form-data">
    <table border="2" >
<thead>
<tbody>
<tr>
<th>Name </th>
<td><input type="text" id="name" name="name" value="" size="35"
onkeypress="return checkName(event)"/></td>
</tr>
<tr>
<th>Age</th>
<td><input type="text" id="age" name="age" value="" size="3"
onkeypress="return doMagic(event)"/></td>
</tr>
<tr>
<th>Department</th>
<td><select name="dept">
<?php foreach($deptArr as $key => $value)  {      
 echo "<option value='$key'>$value</option>";
 } ?>
</select></td>

</tr>
<tr>
<td><input type="submit" value="Submit" name="submit" /></td>
<td><input type="reset" value="Cancel" name="cancel" /></td>
</tr>
</tbody>
</table>

</form>
<table>
<tr>
<td>
<b>click here to see the <a href="table.php" > <i>  Employee List</i> </a> </b>
</td>
</tr>
</table>
</center>


    </body>
</html>

<Script type="text/javascript">
function validate()
{

	var name=document.getElementById("name").value;
    var age =document.getElementById("age").value;
    var isError = false;
       if( name == null|| name== "" )
	{
	alert("Please Enter Employee Name");
    isError = true;
	}


	if(!checkValue()) { isError = true; }
    if (isError == true)
    {
        return false;
    }
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
