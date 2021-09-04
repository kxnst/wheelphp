<?php

namespace WheelPhp\Core\Exceptions;

class ActionNotFound extends \Exception
{
    public $message = "Controller action not found";
};