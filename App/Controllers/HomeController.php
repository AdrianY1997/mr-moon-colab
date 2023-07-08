<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Session;

/**
 * Controlador para la página de inicio.
 */
class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        redirect()->route(constant("HOME"))->send();
    }

    /**
     * Muestra la página de inicio.
     */
    public function home() {
        return self::render("web.home", [
            "session" => Session::checkSession()
        ]);
    }
}
