<?php

namespace WheelPhp\Core\Config;

class Config
{
    protected static array $container = [];

    public static function set(string $name, $value) : void
    {
        self::$container[$name] = $value;
    }

    public static function get(string $name)
    {
        return self::$container[$name];
    }


}