<?php

namespace FoxyMVC\Lib\Foxy\Core;

use FoxyMVC\Lib\Sly\TemplateEngine;

/**
 * Clase base de los controladores
 */
class Controller {
    /**
     * Constructor de la clase Controller
     */
    public function __construct() {
    }

    protected static function render($view, $data = []) {
        $engine = new TemplateEngine();
        $engine->render($view, $data);
    }
}
