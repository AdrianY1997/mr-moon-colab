<?php

namespace FoxyMVC\Lib\Foxy\Core;

use FoxyMVC\App\Models\User;

class Session {
    static private object $data;
    static private array $messages = [];
    static private array $notifications = [];

    static function start() {
        session_start();
        Session::load();
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
            $user = User::where("user_name", $name)->first();
            if (isset($user)) self::$data = $user;
        }
    }

    static function checkSession() {
        return isset($_SESSION["user"]) && $_SESSION["user"] ? true : false;
    }

    static function data($key = null) {
        return $key ? self::$data->$key : self::$data;
    }

    static function setMessage($message) {
        [$key, $value] = explode(":", $message);
        Session::$notifications[$key] = $value;
        $_COOKIE["messages"] = serialize(["notifications" => Session::$notifications]);
        setcookie("messages", serialize(["notifications" => Session::$notifications]), time() + 5, "/");
    }

    static function getMessage() {
        return isset($_COOKIE["messages"]) ? unserialize($_COOKIE["messages"]) : [];
    }
}