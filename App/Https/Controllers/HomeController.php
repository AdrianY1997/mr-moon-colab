<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Base\Controller;
use FoxyMVC\Lib\Foxy\Database\Table;

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