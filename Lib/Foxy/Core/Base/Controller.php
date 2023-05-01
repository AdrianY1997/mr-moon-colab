<?php

namespace FoxyMVC\Lib\Foxy\Core\Base;

use FoxyMVC\App\Models\Webdata;
use FoxyMVC\Lib\Foxy\Core\Session;

/**
 * Clase base de los controladores
 */
class Controller {
    /**
     * Constructor de la clase Controller
     */
    public function __construct() {
        Webdata::initialView();
    }
}
