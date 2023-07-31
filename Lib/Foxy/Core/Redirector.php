<?php

namespace FoxyMVC\Lib\Foxy\Core;

use Exception;
use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\Lib\Foxy\Core\Session;

/**
 * Clase para redirigir a una ruta específica
 */
class Redirector {
    /**
     * Patrón para buscar marcadores de posición en la URL de una ruta
     */
    public const PLACEHOLDER_PATTERN = '/\\{([a-zA-Z0-9_]{1,})\\}/';

    /**
     * Nombre de la ruta a la que se redirigirá
     *
     * @var string
     */
    protected string $route;

    /**
     * Parámetros para reemplazar en la URL de la ruta
     *
     * @var array
     */
    protected array $param;

    /**
     * Código de error
     *
     * @var string
     */
    protected string $code;

    /**
     * Mensaje de error
     *
     * @var mixed
     */
    protected string $message;

    /**
     * Establece la ruta y los parámetros a los que se redirigirá
     *
     * @param string $route Nombre de la ruta
     * @param array $param Parámetros para reemplazar en la URL de la ruta
     * @return $this
     */
    public function route(string $route, array $param = []) {
        $this->route = $route;
        $this->param = $param;
        return $this;
    }

    /**
     * Establece un mensaje para mostrar después de la redirección
     *
     * @param string $message Mensaje a mostrar
     * @return $this
     */
    public function with(string $message) {
        Session::setMessage($message);
        return $this;
    }

    public function success(string $message) {
        Session::setMessage("success:$message");
        return $this;
    }

    public function warning(string $message) {
        Session::setMessage("warning:$message");
        return $this;
    }

    public function error(string $message) {
        Session::setMessage("error:$message");
        return $this;
    }

    /**
     * Realiza la redirección a la ruta especificada
     */
    public function send() {
        try {
            // Obtener la URL de la ruta y redirigir a ella
            $url = $this->getUrlFromRoute($this->route);
            header("Location: " . constant("BASE_URL") . $url);
            exit;
        } catch (Exception $e) {
            // Si ocurre un error al obtener la URL de la ruta, mostrar un mensaje de error
            print "Error inesperado $e";
        }
    }

    /**
     * Obtiene la URL de una ruta a partir de su nombre y reemplaza los marcadores de posición con los parámetros especificados
     *
     * @param string $routeName Nombre de la ruta
     * @return string URL de la ruta con los marcadores de posición reemplazados por los parámetros especificados
     */
    protected function getUrlFromRoute(string $routeName) {
        if (isset($this->route)) {
            // Obtener el objeto Route correspondiente al nombre de la ruta y su URL
            $router = Route::getRoute($routeName);
            $url = $router->getUrl() ?? "";

            // Buscar marcadores de posición en la URL y reemplazarlos por los parámetros especificados si existen
            preg_match_all(Redirector::PLACEHOLDER_PATTERN, $url, $matches);
            foreach ($matches[1] as $match) {
                if (isset($this->param[$match])) {
                    $url = str_replace("{{$match}}", $this->param[$match], $url);
                } else {
                    throw new Exception("Falta el parámetro \"$match\" para la ruta \"$routeName\".");
                }
            }

            return $url;
        }

        throw new Exception("Ruta no encontrada: \"$routeName\"");
    }
}
