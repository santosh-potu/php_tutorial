<?php
session_start();
include_once('Employee.php');

$go=false;
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php

            $tmp =new Employee($_POST['name'],$_POST['id'],$_POST['age']);
            print $tmp;
            check($tmp);
            
	    $_SESSION['emp'][$_SESSION['i']]= $tmp;
            $_SESSION['i']=$_SESSION['i']+1;
			
	    //print_r($_SESSION['emp']);

			if ($go)
			http_redirect ("table.php","",true);       ?>
    </body>
</html>
<?php
    function check(Employee $tmp)
    {
        $t= $_SESSION['emp'];
        //print_r($_SESSION['emp']);
        //print_r($t);
        $tt=new Employee("","","");
        echo "<pre>";
        print_R($_SESSION );
        echo "----end-----";
        for($i=0;$i <= $_SESSION['i']; $i++)
        {
            $tt=$_SESSION['emp'][$i];
            print_r($tt);
            echo " Object ".$tt."End";
        }
        return false;
    }
    ?>