<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class Log extends Table {

    private string $name = "logs";

    public function __construct() {
        parent::__construct($this->name);
    }
}