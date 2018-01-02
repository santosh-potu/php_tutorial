<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors','On');

// check PHPversion
if(!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50400){
    die('PHP version 5.4 or later required');
}

require_once '..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'auto_loader.php';

session_start();
//Db credentials
define(DB_HOST,'localhost');
define(DB_USER,'root');
define(DB_PWD,'root');
define(DB_NAME,'php_tutorial');

//PDO constants
define(PDO_DSN, 'mysql:host='.DB_HOST.';dbname='.DB_NAME);

$auth_required = array('index');