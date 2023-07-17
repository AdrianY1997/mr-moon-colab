<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class UserRole extends Table {
    // -- Generated
    protected static string $tableName = "user_role";
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

    protected array $fillable = [
        "user_id",
        "role_id",
    ];

    // ----

}