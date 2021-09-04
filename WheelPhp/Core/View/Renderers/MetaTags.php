<?php


namespace WheelPhp\Core\View\Renderers;


class MetaTags extends Renderable
{

    public function render() : string
    {
        return implode("\r\n", $this->data);
    }
}