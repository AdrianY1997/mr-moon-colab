<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class Employer extends Table {
    // -- Generated
    public static string $tableName = "employers";
    public Model $model;
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

    public array $fillable = [
        "empl_position",
        "user_id",
    ];

    // ----
}
