<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class Subscriber extends Table {
    // -- Generated
    public static string $tableName = "subscribers";
    public string $subs_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "subs_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $subs_name;
    public string $subs_lastname;
    public string $subs_email;

    public array $fillable = [
        "subs_name",
        "subs_lastname",
        "subs_email",
    ];

    // ----
}
