<?php
namespace System\Traits;

trait View
{
    protected function view($dir, $vars = null)
    {
        $dir = str_replace('.', '/', $dir);
        $path = __DIR__ . "/../../application/view/{$dir}.php";
        if (file_exists($path)) {
            if (is_array($vars)) {
                extract($vars);
            }
            include $path;
        } else {
            echo "❌ View file not found: {$path}";
        }
    }
}
