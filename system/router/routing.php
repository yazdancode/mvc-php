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
    
}