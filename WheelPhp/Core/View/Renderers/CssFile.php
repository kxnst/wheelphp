<?php


namespace WheelPhp\Core\View\Renderers;


class CssFile extends Renderable
{

    public function render() : string
    {
        $markup = "";

        foreach ($this->data as $css) {
            $markup.= "<link rel='stylesheet' href='$css'/>";
        }

        return $markup;
    }
}