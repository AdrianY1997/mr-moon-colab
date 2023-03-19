<?php

namespace Lib\Foxy\Core;

class Schema
{
    static function create(callable $table)
    {
        $query = $table(new Blueprint());

        return $query;
    }
}
