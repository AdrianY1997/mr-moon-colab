<?php

namespace FoxyMVC\Lib\Foxy\Core;

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Database\MySQL;

/**
 * Main class of FoxyMVC
 */
class Application {
    public function __construct() {
        Session::start();
    }

    public function handle() {
        // Obtener la URL de la petición y la ruta correspondiente
        $route = Route::getRouteFromUrl(Request::getUrl());

        // Si no se encuentra una ruta para la URL, redirigir a la página de error
        if (!$route) redirect()->route("error", ["msg" => "page-not-found"])->send();

        // Llamar al método del controlador correspondiente a la ruta con los parámetros necesarios
        call_user_func_array([new $route["controller"], $route["method"]], $route["param"]);

        return $this;
    }

    /**
     * Termina la ejecución de la aplicación
     */
    public function terminate() {
        // Cerrar la conexión a la base de datos
        MySQL::closeConnection();
    }
}