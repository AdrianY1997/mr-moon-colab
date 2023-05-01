<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Base\Controller;

/**
 * Controlador para la página de inicio.
 */
class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index(): void {
        redirect()->route(constant("HOME"))->send();
    }

    public function home(): void {
        render("home");
    }
}
