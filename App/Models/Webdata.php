<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\Model;

class Webdata extends Model {
    public function __construct() {
        parent::__construct("webdatas");
    }

    static function initialView() {
        if (!isset($_COOKIE["webdata"])) {

            $data = new self();
            $data = $data->getAll(["webd_id" => 1]);

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
