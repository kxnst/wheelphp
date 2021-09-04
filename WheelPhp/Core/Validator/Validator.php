<?php

namespace WheelPhp\Core\Validator;

abstract class Validator
{
    public abstract function satisfies(string $needle, string $passed);
}