<?php
namespace System\Router;

use ReflectionMethod;
use System\Traits\View;

class Routing {

    private $currentRoute;

    public function __construct() {
        global $current_route;
        $this->currentRoute = explode('/', $current_route);
    }

    public function run() {
        $controllerFile = realpath(dirname(__FILE__) . "/../../application/controllers/" . $this->currentRoute[0] . ".php");

        if (!file_exists($controllerFile)) {
            #todo: redirect to file 404.php
            echo "404 - فایل کنترلر موجود نیست!";
            exit;
        }

        require_once($controllerFile);
        $method = (sizeof($this->currentRoute) == 1) ? "index" : $this->currentRoute[1];
        $class = "Application\\Controllers\\" . $this->currentRoute[0];

        if (!class_exists($class)) {
            #todo: redirect to file 404.php
            echo "404 - کلاس کنترلر موجود نیست!";
            exit;
        }

        $object = new $class();

        if (method_exists($object, $method)) {
            $reflection = new ReflectionMethod($class, $method);
            $parameterCount = $reflection->getNumberOfParameters();
            $passedParams = array_slice($this->currentRoute, 2);

            if ($parameterCount <= count($passedParams)) {
                call_user_func_array([$object, $method], $passedParams);
            } else {
                #todo: redirect to file 404.php
                echo "404 - تعداد پارامترها نادرست است!";
            }
        } else {
            #todo: redirect to file 404.php
            echo "404 - متد موجود نیست!";
        }
    }
}
