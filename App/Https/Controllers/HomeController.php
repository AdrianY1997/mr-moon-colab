<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Base\Controller;

/**
 * Controlador para la página de inicio.
 */
class HomeController extends Controller {
    /**
     * Muestra la página de inicio.
     */
    public function home(): void {
        render("default/home");
    }
}
