<?php

namespace app;

use WheelPhp\Core\Config\Config;
use WheelPhp\Core\Db\Db;

class Bootstrap extends \WheelPhp\Core\Bootstrap\Bootstrap
{
    public function initRoutes()
    {
        $routes = require_once "Configs/routes.php";
        Config::set("routes", $routes);
    }

    public function initDb()
    {
        $db = require_once "Configs/db.php";
        Config::set("db", $db);
        Db::Connect();
    }
    public function initApp()
    {
        $app = require_once "Configs/application.php";
        Config::set("app", $app);
    }


}