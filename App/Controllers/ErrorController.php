<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\Lib\Foxy\Core\Controller;

/**
 * Controlador para manejar errores.
 */
class ErrorController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Muestra una página de error con un código y un mensaje específicos.
     *
     * @param string $msg Clave del mensaje de error a mostrar.
     */
    public function code(string $msg) {
        // Definir los códigos y mensajes de error disponibles
        $codes = [
            "missing-permissions" => [
                "403",
            ],
            "page-not-found" => [
                "404",
            ],
            "service-unavailable" => [
                "503",
            ]
        ];

        // Mostrar la página de error
        return self::render("web/error", [
            "num" => $codes[$msg][0],
            "cod" => ucwords(str_replace('-', ' ', $msg))
        ]);
    }
}
