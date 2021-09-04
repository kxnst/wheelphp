<?php

namespace WheelPhp\Core\View;

use WheelPhp\Core\Config\Config;
use WheelPhp\Core\View\Renderers\CssFile;
use WheelPhp\Core\View\Renderers\InlineCss;
use WheelPhp\Core\View\Renderers\InlineJs;
use WheelPhp\Core\View\Renderers\JsFile;

/**
 * Class View
 * @package WheelPhp\Core\View
 * @method void setInlineJs @param array $script
 * @method void setInlineCss @param array $script
 * @method void addInlineJs @param string $script
 * @method void addInlineCss @param string $script
 * @method void setJsFile @param array $script
 * @method void addJsFile @param string $script
 * @method void setCssFile @param array $script
 * @method void addCssFile @param string $script
 * @method string renderInlineJs
 * @method string renderInlineCss
 * @method string renderJsFile
 * @method string renderCssFile
 */

class View
{
    private string $layout;

    private string $view;

    private static string $pathToLayouts;

    private static string $pathToViewScripts;

    private static string $viewExtenison;

    private JsFile $jsFile;
    private InlineJs $inlineJs;
    private InlineCss $inlineCss;
    private CssFile $cssFile;

    const SET_NO_RENDER = "noRender";

    public function __construct()
    {
        $app = Config::get("app");
        self::$pathToLayouts = $app['layout_path'];
        self::$pathToViewScripts = $app['view_scripts_path'];
        self::$viewExtenison = $app['view_extension'];
        $this->jsFile = new JsFile();
        $this->inlineJs = new InlineJs();
        $this->inlineCss = new InlineCss();
        $this->cssFile = new CssFile();
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @param string $view
     */
    public function setView(string $view): void
    {
        $this->view = $view;
    }

    public function render()
    {
        if($this->layout != self::SET_NO_RENDER) {
            require_once (self::$pathToLayouts . $this->layout . self::$viewExtenison);
        } else {
            $this->renderView();
        }
    }

    public function renderView()
    {
        require_once (self::$pathToViewScripts . $this->view . self::$viewExtenison);
    }

    public function assign(array $data)
    {
        foreach ($data as $key=>$value) {
            $this->$key = $value;
        }
    }

    public function __call($name, $params)
    {
        //recognize call of add/set methods of script renderers
        if (preg_match("^(add|set|render)([a-zA-Z]+)$^", $name, $matches)) {
            $method = $matches[1];
            $field = lcfirst($matches[2]);
            return $this->$field->{$method}(...$params);
        } else {
            throw new \BadMethodCallException();
        }
    }
}