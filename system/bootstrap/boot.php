<?php 

use System\Router\Routing;
require('system/config.php');

$route = $_GET['route'] ?? '';
$router = new Routing($route);
$router->run();

