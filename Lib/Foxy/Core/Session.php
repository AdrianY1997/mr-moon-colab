<?php

namespace FoxyMVC\Lib\Foxy\Core;

class Session {
    static private array $data = [];
    static private array $messages = [];

    static function start() {
        session_start();
    }

    static function stop() {
        session_unset();
    }

    static function save($name) {
        $_SESSION["user"] = $name;

        return !empty($_SESSION["user"]) ? true : false;
    }

    static function destroy() {
        session_destroy();
    }

    static function load() {
        if (self::checkSession()) {
            $name = $_SESSION["user"];

            /**
             * Instancia la clase para la tabla de usuarios
             * 
             * Sintaxis: `$user = new Model()` donde `Model` se cambia por tu modelo
             * Generalmente la clase es `User()`
             */

            // $user = new User();
            // $user = $user->getAll(["name" => $name], true);

            // if (isset($user[0]))
            //     self::$data = $user[0];
        }
    }

    static function checkSession() {
        return isset($_SESSION["user"]) && $_SESSION["user"] ? true : false;
    }

    static function checkError() {
        if (array_key_exists("error", self::$messages) || array_key_exists("warning", self::$messages)) return true;
        return false;
    }

    static function data($key = null) {
        return $key ? self::$data[$key] : self::$data;
    }

    static function setMessage($message) {
        setcookie("messages", serialize($message), time() + 5, "/");
    }

    static function getMessage() {
        return isset($_COOKIE["messages"]) ? unserialize($_COOKIE["messages"]) : false;
    }
}
