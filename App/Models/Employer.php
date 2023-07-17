<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class Employer extends Table {
    // -- Generated
    protected static string $tableName = "employers";
    public string $empl_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "empl_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $empl_position;
    public string $user_id;

    protected array $fillable = [
        "empl_position",
        "user_id",
    ];

    // ----
}