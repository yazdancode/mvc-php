<?php

namespace System\Router;

class Routing
{
    private $current_route;

    public function __construct()
    {
        global $current_route;
        $this->current_route = explode('/', $current_route);
    }

    public function run(): void
    {
    $controller = basename($this->current_route[0]);
    $path = realpath(dirname(__FILE__) . "/../../application/controllers/" . $controller . ".php");

    if (!file_exists($path)) {
        echo "404 - file not exists!";
        exit;
    }
    require_once $path;
    $method = sizeof($this->current_route) === 1 ? "index" : $this->current_route[1];
    $class = "Application\\Controllers\\" . $controller;
    
    }
}