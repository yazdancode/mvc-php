<?php

namespace System\Router;

use ReflectionException;
use ReflectionMethod;

class Routing
{
    private array $currentRoute;

    public function __construct(string $route)
    {
        $route = trim($route, '/');
        $this->currentRoute = explode('/', $route);
    }

    public function run(): void
    {
        $controller = ucfirst(basename($this->currentRoute[0] ?? 'Home'));
        $controllerFile = dirname(__DIR__, 2) . "/application/controllers/$controller.php";
        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo "404 - Controller file not found!";
            return;
        }

        require_once $controllerFile;

        $className = "Application\\Controllers\\$controller";
        if (!class_exists($className)) {
            http_response_code(404);
            echo "404 - Controller class not found!";
            return;
        }

        $object = new $className();
        $method = $this->currentRoute[1] ?? 'index';
        if (!method_exists($object, $method)) {
            http_response_code(404);
            echo "404 - Method not found!";
            return;
        }

        try {
            $reflection = new ReflectionMethod($className, $method);
        } catch (ReflectionException $e) {
            http_response_code(500);
            echo "500 - Reflection error!";
            return;
        }
        $params = array_slice($this->currentRoute, 2);
        if (count($params) < $reflection->getNumberOfRequiredParameters()) {
            http_response_code(400);
            echo "400 - Missing required parameters!";
            return;
        }
        call_user_func_array([$object, $method], $params);
    }
}
