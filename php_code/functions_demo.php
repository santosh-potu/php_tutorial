<!DOCTYPE html>
<?php
$even_decider = 2;
require_once 'library/functions.php';
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>PHP Functions ,Include & Require Demo</title>
    </head>
    <body>
        <?php
        // put your code here
        $x = 4;
        echo " Number $x is Even: ".isEven($x)."<br/>";
        echo " Exmple without parameter: ".isEven()."<br/>";
        echo " Exmple with parameter: ".add(1,2,3)."<br/>";
        echo " Exmple with default parameter ".add(1,2)."<br/>";
        demoStatic();
        demoStatic();
        demoStatic();
        ?>
    </body>
</html>
