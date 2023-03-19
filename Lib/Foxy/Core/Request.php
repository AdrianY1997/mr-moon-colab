<?php

namespace Lib\Foxy\Core;

class Request
{
    public function __construct()
    {
    }

    /**
     * Obtiene todos los datos enviados atravez de `GET` y `POST`
     * @return array Retorna un `array` con todos los datos
     */
    static function getData()
    {
        return array_map(function ($value) {
            return strip_tags(htmlspecialchars($value));
        }, array_merge($_GET, $_POST));
    }

    /**
     * Obtiene la url y subdivide para enviar al controlador
     * 
     * @return array Retorna un array con los datos tomados 
     * 
     * `controlador`, `método`, `parámetros`
     */
    static function getUrl(): string
    {
        $URL = urldecode(constant("URL"));
        $length = strlen(constant("BASE_URL"));

        $url = substr($URL, $length);

        return $url;
    }
}
