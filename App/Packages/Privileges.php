<?php

namespace FoxyMVC\App\Packages;

use FoxyMVC\Lib\Foxy\Core\Session;

enum Privileges: int {
    case User = 1;
    case Admin = 2;
    case Master = 4;

    public function get(): int {
        return match ($this) {
            static::User => 1,
            static::Admin => 2,
            static::Master => 4
        };
    }

    public static function check(int $privileges) {
        return ($privileges & Session::data("user_privileges")) == $privileges ? true : false;
    }
}