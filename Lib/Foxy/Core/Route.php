<?php

namespace FoxyMVC\Lib\Foxy\Core;

/**
 * Clase para manejar la rutas del software
 */
class Route {
    /**
     * Listado de rutas guardadas con el metodo set
     * 
     * @var array
     */
    static array $routes = [];

    /**
     * Nombre que se le asigna a la ruta
     *
     * @var string
     */
    protected string $name;

    /**
     * Url asignada
     *
     * @var string
     */
    protected string $url;

    /**
     * Nombre del controlador asignado a la ruta
     *
     * @var string
     */
    protected string $controller;

    /**
     * Nombre de la función asignada a la ruta
     *
     * @var string
     */
    protected string $method;

    /**
     * Constructor de la clase Route
     *
     * @param string $url
     * @param string[] $action
     */
    public function __construct(string $url, array $action) {
        $this->url = $url;
        $this->controller = $action[0];
        $this->method = $action[1];
    }

    /**
     * Asigna el nombre de la ruta
     *
     * @param string $name
     * @return Route
     */
    public function name($name): Route {
        $this->name = $name;
        self::$routes[$name] = $this;
        return $this;
    }

    /**
     * Obtiene la url de la ruta
     *
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * Obtiene el nombre de la ruta
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Obtiene el nombre del controlador de la ruta
     *
     * @return string
     */
    public function getController(): string {
        return $this->controller;
    }

    /**
     * Obtiene el método asignado en la ruta
     *
     * @return string
     */
    public function getMethod(): string {
        return $this->method;
    }

    /**
     * Carga las rutas desde la carpeta de rutas
     *
     * @return void
     */
    static public function loadRoutes(): void {
        $routes = glob("Routes\\*.php");
        foreach ($routes as $value) {
            require_once $value;
        }
    }

    /**
     * Retorna una instancia de la clase Route
     *
     * @param string $url
     * @param string[] $action
     * @return Route
     */
    static public function set($url, $action): Route {
        return new self($url, $action);
    }

    /**
     * Obtiene el una instancia guardada en el listado de rutas según el nombre dado
     *
     * @param string $name
     * @return Route
     */
    static function getRoute($name): Route {
        return self::$routes[$name];
    }

    /**
     * Obtiene un array asociativo con el controlador, método y parámetros según la url dada
     *
     * @param string $url
     * @return array|false
     */
    static public function getRouteFromUrl($url) {
        // Carga las rutas guardadas
        self::loadRoutes();

        foreach (Route::$routes as $route) {
            $routeUrl = $route->getUrl();

            // Reemplazar los marcadores con una expresión regular
            $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $routeUrl);

            // Agregar caracteres de inicio y fin a la expresión regular
            $routeRegex = '/^' . str_replace('/', '\/', $routeRegex) . '$/';

            // Si la URL coincide con la expresión regular, obtener el controlador, método y parámetros
            if (preg_match($routeRegex, $url, $matches)) {
                $params = $matches;

                // Eliminar la primera coincidencia (la URL completa)
                unset($params[0]);

                foreach ($params as $key => $value) {
                    if (is_int($key))
                        unset($params[$key]);
                }

                return [
                    "controller" => $route->getController(),
                    "method" => $route->getMethod(),
                    "param" => $params
                ];
            }
        }

        return false;
    }
}