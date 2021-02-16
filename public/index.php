<?php
require_once("../conf/config.php");

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$router = new Core\Router();

$router->add('',['controller'=>'Home', 'action'=>'index']);
$router->add('{controller}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);