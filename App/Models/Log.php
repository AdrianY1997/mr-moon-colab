<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\Model;

/**
 * Modelo para los registros
 */
class Log extends Model {
    /**
     * Constructor de la clase Log
     */
    public function __construct() {
        parent::__construct("logs");
    }
}
