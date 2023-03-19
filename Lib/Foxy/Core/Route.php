<?php

namespace Lib\Foxy\Core;

class Route
{
    static $routes = [];
    protected $name;
    protected $url;
    protected $controller;
    protected $method;
    protected $params;

    public function __construct($url, $action)
    {
        $this->url = $url;
        $this->controller = $action[0];
        $this->method = $action[1];
    }

    public function name($name)
    {
        $this->name = $name;
        self::$routes[$name] = $this;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    static public function set($url, $action)
    {
        return new self($url, $action);
    }

    static function getRoute($name)
    {
        return self::$routes[$name];
    }

    static public function getRouteFromUrl($url)
    {
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