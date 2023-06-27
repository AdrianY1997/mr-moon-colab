<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Base\Controller;
use FoxyMVC\Lib\Foxy\Core\Session;

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
        render("web.home", [
            "session" => Session::checkSession()
        ]);
    }
}