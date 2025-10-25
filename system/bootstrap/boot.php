<?php 

session_start();
use System\Router\Routing;
require_once('system/config.php');
require_once('system/bootstrap/Autoload.php');
$autoload = new System\Bootstrap\Autoload();
$autoload->autoloader();
$route = $_GET['route'] ?? '';
$router = new Routing($route);
$router->run();