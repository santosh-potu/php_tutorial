<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//error_reporting(E_ALL);
ini_set('display_errors', 'on');
set_include_path('..'.DIRECTORY_SEPARATOR.'php_code'.DIRECTORY_SEPARATOR);
require_once 'library'.DIRECTORY_SEPARATOR.'config.php';

?>
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
        if(strlen($_REQUEST['source']) > 0 && is_file($_REQUEST['source'])){
    $file_content = file_get_contents($_REQUEST['source']);
    $lines = substr_count($file_content,"\n");
    
    echo "<textarea rows='$lines' cols='100' readonly='true'>".($file_content)."</textarea>";
    exit;
}
        $current_dir_files = scandir('.');
        
    if(count($current_dir_files) > 3 ){
        
        ?>
        <table border="3" style="margin:5%;" valign="center" width="60%">
            <thead>
                    <th>Link</th>
                    <th>Description</th>
                    <th>&nbsp;</th>
            </thead>
        <?php
        foreach($current_dir_files as $file){
            $current_file = basename($_SERVER['PHP_SELF']);
            /* can use
             * [SCRIPT_FILENAME] => /var/www/innosoul/index.php
                [REQUEST_URI] => /innosoul/index.php
                [SCRIPT_NAME] => /innosoul/index.php
             * 
             * 
             */ 
            if(is_file($file) && $file != $current_file){
                /* $content = file_get_contents($file);
                $content = preg_replace('^?php*$?', '', $content);
                echo "<pre>";
                print_r($content);
                echo "</pre>";
                die();
                $DOM = new DOMDocument;
                $DOM->loadHTMLFile($file);
                $title = $DOM->getElementsByTagName('title');
                echo "<pre>";
                print_r($title);
                echo "</pre>";
                die();?*/
                echo "<tr><td align='right'><a href='$file'>$file</a></td>
                          <td></td>
                          <td><a href='?source=$file'>View Source</a></td></tr>";
                
            }
            
        }

    }        
       
        ?>
        </body>
    
</html>
