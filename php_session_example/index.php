<?php
require_once 'config'.DIRECTORY_SEPARATOR.'config.php';

$app = Sanumakrish\Application::getInstance();

$db = $app->getDbConnection();

echo "<pre>";
print_r($db);
echo "</pre>";
die();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

