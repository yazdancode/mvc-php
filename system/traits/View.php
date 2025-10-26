<?php
namespace System\Traits;

trait View
{

    protected function renderView($dir, $vars = null): void
    {
        $dir = str_replace('.', '/', $dir);
        $path = __DIR__ . "/../../application/view/$dir.php";

        if (file_exists($path)) {
            if (is_array($vars)) {
                extract($vars);
            }
            include $path;
        } else {
            echo "❌ View file not found: $path";
        }
    }


    protected function view($dir, $vars = null): void
    {
        $this->renderView($dir, $vars);
    }


    protected function include($dir, $vars = null): void
    {
        $this->renderView($dir, $vars);
    }


    protected function asset($dir): void
    {
        global $base_url;
        echo $base_url . "public/" . ltrim($dir, '/');
    }

    
    protected function url($url): void
    {
        global $base_url;
        echo $base_url . ltrim($url, '/');
    }
}
