<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>﻿
<html>
    <head>
        <title>
            List of PHP Programs
        </title>
        <style>
            table thead{
                background-color:#d03b2c; 
            }
            table td{
                background-color:#73d02c;
            }
        </style>
    </head>
    <body>
        <?php
        
        $current_dir_files = scandir('.');
        ?>
        <table border="3" style="margin:5%;" valign="center" width="60%">
            <thead>
                    <th>Link</th>
                    
            </thead>
        <?php
        foreach($current_dir_files as $file){
             
            if(is_dir($file) && $file[0] != '.' ){
                
                echo "<tr><td align='center'><a href='$file'>$file</a></td>
                          </tr>";
                
            }
            
        }
        
        ?>
        </body>
    
</html>
