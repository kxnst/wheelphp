<?php

namespace WheelPhp\Core\View\Renderers;

abstract class Renderable
{
    protected array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public abstract function render() : string;

    public function add(string $renderable)
    {
        $this->data []= $renderable;
    }
    public function set(array $renderable)
    {
        $this->data = $renderable;
    }
}