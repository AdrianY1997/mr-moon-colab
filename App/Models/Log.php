<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class Log extends Table {
    /**
     * Constructor de la clase Log
     */
    public function __construct() {
        parent::__construct("logs");
    }
}