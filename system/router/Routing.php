<?php
namespace System\Router;

use JetBrains\PhpStorm\NoReturn;
use ReflectionException;
use ReflectionMethod;

class Routing
{
    private array $currentRoute;

    public function __construct()
    {
        global $current_route;
        $route = isset($current_route) ? trim($current_route, '/') : '';
        $this->currentRoute = $route === '' ? ['Home'] : explode('/', $route);
        if (empty($this->currentRoute[0])) {
            $this->currentRoute[0] = 'Home';
        }
    }

    public function run(): void
    {
        $controllerName = $this->currentRoute[0];
        $controllerFile = __DIR__ . '/../../application/controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            $this->abort404("کنترلر یافت نشد.");
        }

        require_once $controllerFile;
        $method = (count($this->currentRoute) === 1) ? "index" : $this->currentRoute[1];
        $class = "Application\\Controllers\\" . $controllerName;

        if (!class_exists($class)) {
            $this->abort404("کلاس کنترلر موجود نیست");
        }

        $object = new $class();

        if (!method_exists($object, $method)) {
            $this->abort404("متد موجود نیست");
        }

        try {
            $reflection = new ReflectionMethod($class, $method);
        } catch (ReflectionException $e) {
            $this->abort404("خطا در بازتاب متد: " . $e->getMessage());
        }

        $passedParams = array_slice($this->currentRoute, 2);
        $paramCount = $reflection->getNumberOfParameters();
        if (count($passedParams) > $paramCount) {
            $this->abort404("تعداد پارامترهای ارسالی بیش از حد مجاز است.");
        }
        call_user_func_array([$object, $method], $passedParams);
    }

    #[NoReturn]
    private function abort404(string $message = ''): void
    {
        http_response_code(404);
        $errorViewPath = __DIR__ . '/../../application/views/errors/404.php';

        if (file_exists($errorViewPath)) {
            if ($message) {
                echo "<!-- خطای داخلی: $message -->\n";
            }
            require $errorViewPath;
        } else {
            echo "<!DOCTYPE html>
<html lang=\"fa\" dir=\"rtl\">
<head>
    <meta charset=\"UTF-8\">
    <title>404 - صفحه یافت نشد</title>
    <style>body{font-family:tahoma,arial,sans-serif;text-align:center;padding:50px;background:#f9f9f9;}</style>
</head>
<body>
    <h1>404 - صفحه مورد نظر یافت نشد!</h1>";
            if ($message) {
                echo "<p style=\"color:#d63031;\">$message</p>";
            }
            echo "</body></html>";
        }

        exit;
    }
}