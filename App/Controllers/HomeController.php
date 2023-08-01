<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Subscriber;
use FoxyMVC\App\Models\User;
use FoxyMVC\App\Privileges;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Request;

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
            "session" => Session::checkSession(),

        ]);
    }
    public function sus(){

        $data = Request::getData();
        
        $user = new Subscriber();

        $user->subs_name = $data["name"];
        $user->subs_lastname = $data["lastname"];
        $user->subs_email = $data["email"];

        if (!Subscriber::insert($user)) {
            redirect()
                ->route(constant('HOME'))
                ->error("No se ha podido agregar al boletin, contacte con un administrador")
                ->send();
        }

        redirect()
            ->route(constant('HOME'))
            ->success("Usted se ha registrado con éxito, ". $data["name"]." bienvenido a la familia Mr. Moon")
            ->send();

    }
}