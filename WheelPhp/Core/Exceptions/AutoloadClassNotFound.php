<?php

namespace WheelPhp\Core\Exceptions;

class AutoloadClassNotFound extends \Exception
{
    public $message = "Class, loaded by autoloader, isn`t found";
}