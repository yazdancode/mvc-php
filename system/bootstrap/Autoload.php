<?php
namespace System\Bootstrap;

class Autoload
{
    public function autoloader(): void
    {
        spl_autoload_register(static function ($className) {
            $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
            $fullPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'mvc' . DIRECTORY_SEPARATOR . $filePath . '.php';
            if (file_exists($fullPath)) {
                include_once $fullPath;
            }
        });
    }
}