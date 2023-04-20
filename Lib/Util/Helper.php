<?php

use Lib\Foxy\Core\Redirector;
use Lib\Foxy\Core\Route;

if (!function_exists("asset")) {
    function asset($path)
    {
        return constant("BASE_URL") . "Public/" . $path;
    }
}

if (!function_exists("resource")) {
    function resource($path)
    {
        return constant("BASE_URL") . "Resources/" . $path;
    }
}

if (!function_exists("render")) {
    function render($view, $data = [])
    {
        foreach (array_keys($data) as $e) {
            ${$e} = $data[$e];
        }

        include "Resources/Views/app.php";
    }
}

if (!function_exists("extend")) {
    function extend($view, $data = [])
    {
        foreach (array_keys($data) as $e) {
            ${$e} = $data[$e];
        }
        return include "Resources/Views/" . $view . ".php";
    }
}

if (!function_exists("route")) {
    function route($name, $params = [])
    {
        $router = Route::getRoute($name);
        $url = $router->getUrl() ?? "";

        foreach ($params as $key => $value) {
            $url = str_replace("{{$key}}", $value, $url);
        }

        return constant("BASE_URL") . $url;
    }
}

if (!function_exists("redirect")) {
    function redirect()
    {
        return new Redirector;
    }
}
