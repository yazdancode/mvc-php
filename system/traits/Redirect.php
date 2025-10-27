<?php 
namespace System\Traits;

use JetBrains\PhpStorm\NoReturn;

trait Redirect
{
    #[NoReturn]
    protected function redirect($url):void
    {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') !== false ? 'https://' : 'http://';
        header("Location: " . $protocol . $_SERVER['HTTP_HOST'] . "/mvc/" . $url);
        exit;
    }

    protected function back():void
    {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        echo 'Route not found';
    }
}
