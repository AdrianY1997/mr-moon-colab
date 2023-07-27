<?php

namespace FoxyMVC\App\Packages;

enum Privileges: int {
    case User = 1;
    case Admin = 2;

    public function get(): int {
        return match ($this) {
            static::User => 1,
            static::Admin => 2,
        };
    }
}