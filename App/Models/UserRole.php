<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class UserRole extends Table {
    // -- Generated
    public static string $tableName = "user_role";
    public Model $model;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $user_id;
    public string $role_id;

    public array $fillable = [
        "user_id",
        "role_id",
    ];

    // ----

}
