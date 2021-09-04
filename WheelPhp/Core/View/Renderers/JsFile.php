<?php


namespace WheelPhp\Core\View\Renderers;


class JsFile extends Renderable
{

    public function render() : string
    {
        $markup = "";

        foreach ($this->data as $js) {
            $markup.= "<script src='$js'></script>";
        }

        return $markup;
    }
}