<?php

use FoxyMVC\App\Packages\Privileges;
use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\Lib\Foxy\Core\Redirector;
use FoxyMVC\Lib\Foxy\Core\Session;

if (!function_exists("asset")) {
    function asset($path) {
        return constant("BASE_URL") . "Public/" . $path;
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

if (!function_exists("formatString")) {
    function formatString($input) {
        $input = strip_tags($input);
        // $input = mysqli_real_escape_string($conexion, $input); // Descomenta esta línea si estás usando MySQLi
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }
}

if (!function_exists("search_file")) {
    function search_file($ruta, $patron) {
        $archivos = array();
        if ($handle = opendir($ruta)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if (is_dir($ruta . '/' . $entry)) {
                        $archivos = array_merge($archivos, search_file($ruta . '/' . $entry, $patron));
                    } else {
                        if (fnmatch($patron, $entry)) {
                            $archivos[] = $ruta . '/' . $entry;
                        }
                    }
                }
            }
            closedir($handle);
        }
        return $archivos;
    }
}

if (!function_exists("redirect")) {
    function redirect() {
        return new Redirector;
    }
}

if (!function_exists("resource")) {
    function resource($path) {
        return constant("BASE_URL") . "Resources/" . $path;
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

if (!function_exists("wordsDate")) {
    function wordsDate($timestamp) {
        $timestamp = explode(" ", $timestamp)[0];
        $timestamp = date("F j, Y", strtotime($timestamp));
        return $timestamp;
    }
}