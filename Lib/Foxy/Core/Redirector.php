<?php

namespace Lib\Foxy\Core;

use Exception;

class Redirector
{
    const PLACEHOLDER_PATTERN = '/\\{([a-zA-Z0-9_]{1,})\\}/';

    protected $route;
    protected $param;
    protected $code;
    protected $message;

    public function route($route, $param = [])
    {
        $this->route = $route;
        $this->param = $param;

        return $this;
    }

    public function with(string $code = "", array $message = [])
    {
        if ($message) {
            $this->code = $message['code'] ?? $message[0];
            $this->message = $message['message'] ?? $message[1];
            $this->appendMessage();
        } else
            $this->code = $code;

        return $this;
    }

    public function message(string $message)
    {
        $this->message = $message;
        $this->appendMessage();

        return $this;
    }

    public function send()
    {
        try {
            $url = $this->getUrlFromRoute($this->route);
            header("Location: " . constant("BASE_URL") . "$url");
            exit;
        } catch (Exception $e) {
            print "Error inesperado $e";
        }
    }

    protected function appendMessage()
    {
        if (!$this->code)
            return;

        Session::setMessage($this->code, $this->message);
    }

    protected function getUrlFromRoute($routeName)
    {
        if (isset($this->route)) {
            $router = Route::getRoute($routeName);
            $url = $router->getUrl() ?? "";

            preg_match_all('/\\{([a-zA-Z0-9_]{1,})\\}/', $url, $matches);
            foreach ($matches[1] as $match) {
                if (isset($this->param[$match])) {
                    $url = str_replace("{{$match}}", $this->param[$match], $url);
                } else {
                    throw new Exception("Falta el parámetro $match para la ruta $routeName.");
                }
            }

            return $url;
        }

        throw new Exception("Ruta no encontrada: $routeName");
    }

    static function handleError($code)
    {
        // Try to redirect to the error controller
        try {
            $route = Route::$routes["error"];

            return [
                "controller" => $route->getController(),
                "method" => $route->getMethod(),
                "param" => [
                    "code" => $code
                ]
            ];
        } catch (Exception $e) {
            // If the redirect fails, show a generic error message
            echo "Error: $code";
            exit;
        }
    }
}
