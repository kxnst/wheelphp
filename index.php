<?php

spl_autoload_register(function ($name) {
    if (!file_exists($name . '.php')) {
        throw new \WheelPhp\Core\Exceptions\AutoloadClassNotFound();
    }
    require_once $name . '.php';
});

\WheelPhp\Core\Config\Config::set("request", new \WheelPhp\Core\Http\Request());

require_once "vendor/autoload.php";
$bootstrap = new app\Bootstrap();

$bootstrap->Bootstrap();