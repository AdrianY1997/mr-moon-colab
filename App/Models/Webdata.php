<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class Webdata extends Table {
    protected static string $table = "webdatas";

    static function initialView() {
        if (!isset($_COOKIE["webdata"])) {

            $data = self::where("webd_id", 1)->get();

            $s = $m = $h = $d = 1;
            $expires = time() + $s * $m * $h * $d;

            setcookie("webdata", serialize($data[0]), $expires, "/");
            $_COOKIE["webdata"] = serialize($data[0]);
        }

        return null;
    }

    static function data() {
        return unserialize($_COOKIE["webdata"]);
    }
}