<?php

namespace WheelPhp\Core\Http;

class Request
{
    protected array $data = [];

    const POST = 1;
    const GET = 0;

    protected int $type;

    public function __construct()
    {
        if (count($_POST)) {
            $this->type = self::POST;
        } else {
            $this->type = self::GET;
        }
        $this->data['post'] = $_POST;
        $this->data['get'] = $_GET;
        $this->data['request'] = $_REQUEST;
        $this->data['server'] = $_SERVER;
        $this->data['cookie'] = $_COOKIE;
        $this->data['session'] = $_SESSION;
    }

    public function get(string $name)
    {
        return $this->data[$name];
    }

    public function set(string $name, $value)
    {
        $this->data[$name] = $value;
    }
}