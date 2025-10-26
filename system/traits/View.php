<?php
namespace System\Traits;

trait View
{
    // تابع اصلی برای بارگذاری ویوها
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

    // بارگذاری یک ویو اصلی
    protected function view($dir, $vars = null): void
    {
        $this->renderView($dir, $vars);
    }

    // بارگذاری یک ویوی جزئی (partial)
    protected function include($dir, $vars = null): void
    {
        $this->renderView($dir, $vars);
    }

    // تولید آدرس کامل برای فایل‌های assets
    protected function asset($dir): void
    {
        global $base_url;
        echo $base_url . "public/" . ltrim($dir, '/');
    }

    // تولید آدرس کامل برای مسیرهای داخلی
    protected function url($url): void
    {
        global $base_url;
        echo $base_url . ltrim($url, '/');
    }
}
