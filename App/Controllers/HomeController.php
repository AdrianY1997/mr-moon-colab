<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\Lib\Foxy\Core\Controller;

/**
 * Controlador para la página de inicio.
 */
class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Muestra la página de inicio.
     */
    public function home(): void {
        render("web.home");
    }
}
