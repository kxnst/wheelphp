<?php


namespace WheelPhp\Core\View\Renderers;


class InlineCss extends Renderable
{
    public function render() : string
    {
        if (!count($this->data)) {
            return "";
        }

        $markup = "<style>";

        foreach ($this->data as $css) {
            $markup .= "\r\n$css";
        }

        $markup .= "</style>";

        return $markup;
    }
}