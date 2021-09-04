<?php


namespace WheelPhp\Core\Validator;


class Equals extends Validator
{

    public function satisfies(string $needle, string $passed)
    {
        return $needle == $passed;
    }
}