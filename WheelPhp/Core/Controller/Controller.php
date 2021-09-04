<?php

namespace WheelPhp\Core\Controller;

use WheelPhp\Core\View\View;

abstract class Controller
{
    protected View $view;

    public abstract function init();

    public abstract function preDispatch();

    public abstract function postDispatch();

    public function __construct()
    {
        $this->init();
        $this->preDispatch();
    }

    public function __destruct()
    {
        $this->postDispatch();
    }

}