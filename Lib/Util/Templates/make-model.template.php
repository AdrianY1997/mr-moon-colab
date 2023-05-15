<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class __model extends Table {

    private string $name = "__tableName";

    public function __construct() {
        parent::__construct($this->name);
    }
}