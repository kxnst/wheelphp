<?php

namespace WheelPhp\Core\Bootstrap;

use WheelPhp\Core\Config\Config;

abstract class Bootstrap
{
    public function Bootstrap()
    {
        $methods = get_class_methods($this);
        foreach ($methods as $method) {
            if (preg_match('/init[A-Za-z_]+/', $method)) {
                $this->$method();
            }
        }

        foreach ($methods as $method) {
            if (preg_match('/[A-Za-z_]+Init/', $method)) {
                $this->$method();
            }
        }
    }

    public function dispatcherInit()
    {
        $dispatcher = new \WheelPhp\Core\Dispatcher\Dispatcher();
        $dispatcher->dispatch(Config::get("request"));
    }
}