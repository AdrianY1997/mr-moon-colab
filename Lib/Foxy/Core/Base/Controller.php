<?php

namespace FoxyMVC\Lib\Foxy\Core\Base;

use FoxyMVC\Lib\Foxy\Core\Session;

/**
 * Clase base de los controladores
 */
class Controller {
    /**
     * Constructor de la clase Controller
     */
    public function __construct() {
        // Asigna a las variables globales mensajes de notificación
        $GLOBALS["messages"] = Session::getMessage();
    }
}
