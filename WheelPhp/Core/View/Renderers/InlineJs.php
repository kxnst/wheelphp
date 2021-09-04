<?php


namespace WheelPhp\Core\View\Renderers;


class InlineJs extends Renderable
{

    public function render() : string
    {
        if (!count($this->data)) {
            return "";
        }

        $markup = "<script>";

        foreach ($this->data as $js) {
            $markup .= "\r\n$js";
        }

        $markup .= "</script>";

        return $markup;
    }
}