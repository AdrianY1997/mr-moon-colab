<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class Webdata extends Table {
    // -- Generated
    public static string $tableName = "webdatas";
    public Model $model;
    public string $webd_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "webd_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $webd_name;
    public string $webd_subt;
    public string $webd_logo;
    public string $webd_email;
    public string $webd_phone;
    public string $webd_address;
    public string $webd_city;
    public string $webd_fblink;
    public string $webd_twlink;
    public string $webd_iglink;
    public string $webd_ytlink;
    public string $webd_m;
    public string $webd_v;

    public array $fillable = [
        "webd_name",
        "webd_subt",
        "webd_logo",
        "webd_email",
        "webd_phone",
        "webd_address",
        "webd_city",
        "webd_fblink",
        "webd_twlink",
        "webd_iglink",
        "webd_ytlink",
        "webd_m",
        "webd_v",
    ];

    // ----

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
