<?php

namespace WheelPhp\Core\Db;

class Db
{
    private static \mysqli $connection;

    public static function Connect() : void
    {
        $dbConfig =  \WheelPhp\Core\Config\Config::get("db");
        self::$connection = new \mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['db_name']);
    }

    public static function __callStatic($name, $arguments)
    {
        if (method_exists(self::$connection, $name)) {
            $result = self::$connection->{$name}(...$arguments);
            return $result;
        } else {
            die ("Method doesn`t exist");
        }
    }
}