<?php


namespace WheelPhp\Core\Validator;


use WheelPhp\Core\Config\Config;

class Regex extends Validator
{

    public function satisfies(string $regex, string $passed)
    {
        $result =  preg_match($regex, $passed, $matches);
        Config::set("validator_regex", $matches);
        return $result;
    }
}