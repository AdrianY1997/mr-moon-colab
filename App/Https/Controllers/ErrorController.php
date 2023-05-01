<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Base\Controller;

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
    public function code(string $msg): void {

        // Definir los códigos y mensajes de error disponibles
        $codes = [
            "page-not-found" => [
                "404",
                "The page you're looking for no longer exits <br> return to the home page and remember: you haven't seen anything."
            ],
            "service-unavailable" => [
                "503",
                "Sorry, this page is currently under construction or undergoing maintenance. Please check back later."
            ]
        ];

        // Obtener el código y el mensaje de error correspondientes a la clave proporcionada
        [$code, $subtitle] = $codes[$msg];

        // Mostrar la página de error
        render("error", [
            "code" => $code,
            "subtitle" => $subtitle
        ]);
    }
}
