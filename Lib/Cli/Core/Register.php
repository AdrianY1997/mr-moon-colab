<?php

namespace Lib\Cli\Core;

class Register
{
    static protected $commands = [];

    static function command(string $cmd, array $sub)
    {
        self::setCommand(["cmd" => $cmd, "sub" => $sub]);
    }

    static function setCommand(array $properties)
    {
        self::$commands[$properties["cmd"]] = $properties["sub"];
    }

    static function checkCommand($c)
    {
        if (array_key_exists($c[0], self::$commands) && array_search($c[1], Register::$commands[$c[0]]) >= 0)
            return true;
        return false;
    }
}
