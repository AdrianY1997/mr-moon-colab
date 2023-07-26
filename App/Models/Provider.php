<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class Provider extends Table {
    // -- Generated
    public static string $tableName = "providers";
    public Model $model;
    public string $prov_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "prov_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $prov_nit;
    public string $prov_name;
    public string $prov_email;
    public string $prov_phone;

    public array $fillable = [
        "prov_nit",
        "prov_name",
        "prov_email",
        "prov_phone",
    ];

    // ----
}
