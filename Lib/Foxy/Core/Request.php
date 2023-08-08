<?php

namespace FoxyMVC\Lib\Foxy\Core;

/**
 * Clase para manejar la petición del usuario
 */
class Request {
    /**
     * Obtiene todos los datos enviados a través de `GET` y `POST`
     * @return array Retorna un `array` con todos los datos
     */
    static function getData() {
        // Fusionar los datos de `GET` y `POST` y limpiar cada valor
        return array_map(function ($value) {
            return strip_tags(htmlspecialchars($value));
        }, array_merge($_GET, $_POST));
    }

    /**
     * Obtiene la URL de la petición del usuario
     *
     * @return string URL de la petición del usuario
     */
    static function getUrl(): string {
        // Obtener la URL de la petición y eliminar la parte correspondiente a la URL base
        $URL = urldecode(constant("URL"));
        $length = strlen(constant("BASE_URL"));
        return substr($URL, $length);
    }

    static function getFormData() {
        if ($data = file_get_contents("php://input")) {
            return json_decode($data);
        }
        
        return array_merge($_POST, $_GET, $_FILES);
    }
}