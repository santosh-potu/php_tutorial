<?php


spl_autoload_register('app_autoloader');

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors','On');

session_start();

if ($_SERVER["SERVER_NAME"] != 'localhost') {
    define(DB_HOST,'mysql1.000webhost.com');
    define(DB_USER,'a4832129_spotu16');
    define(DB_PWD,'psreddy82');
    define(DB_NAME,'a4832129_spotu16');
} else {
    define(DB_HOST,'localhost');
    define(DB_USER,'root');
    define(DB_PWD,'root');
    define(DB_NAME,'php_tutorial');
}

define(PDO_DSN, 'mysql:host='.DB_HOST.';dbname='.DB_NAME);

/**
 * Autoload handler 
 * 
 * @param String $class
 */
function app_autoloader($class){    
    
    $class_file_path = explode("\\", $class);
    $class_file = strtolower(array_pop($class_file_path)).'.class.php';
    
    $exceptional_directories = array(
                                'Sanumakrish'=>'classes'
                                );
    
    foreach ($class_file_path as $dir_ele) {
        if ($exceptional_directories[$dir_ele]) {
            $dir_ele = $exceptional_directories[$dir_ele];
        }
        $class_dir_path .= $dir_ele.DIRECTORY_SEPARATOR ;
    }
    //remove first 2 for realtive path
    $abs_file_path = getcwd().DIRECTORY_SEPARATOR.$class_dir_path.$class_file;
    
    if (file_exists($abs_file_path)) {
        require_once $abs_file_path;
    }
    
}

