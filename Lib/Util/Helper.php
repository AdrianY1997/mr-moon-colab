<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\Lib\Sly\TemplateEngine;
use FoxyMVC\Lib\Foxy\Core\Redirector;

if (!function_exists("formatString")) {
    function formatString($input) {
        $input = strip_tags($input);
        // $input = mysqli_real_escape_string($conexion, $input); // Descomenta esta línea si estás usando MySQLi
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }
}

if (!function_exists("asset")) {
    function asset($path) {
        return constant("BASE_URL") . "Public/" . $path;
    }
}

if (!function_exists("resource")) {
    function resource($path) {
        return constant("BASE_URL") . "Resources/" . $path;
    }
}

if (!function_exists("extend")) {
    function extend($view, $data = []) {
        foreach (array_keys($data) as $e) {
            ${$e} = $data[$e];
        }
        return include "Resources/Views/" . $view . ".sly.php";
    }
}

if (!function_exists("route")) {
    function route($name, $params = []) {
        $router = Route::getRoute($name);
        $url = $router->getUrl() ?? "";

        foreach ($params as $key => $value) {
            $url = str_replace("{{$key}}", $value, $url);
        }

        return constant("BASE_URL") . $url;
    }
}

if (!function_exists("redirect")) {
    function redirect() {
        return new Redirector;
    }
}
