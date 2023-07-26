<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class Code extends Table {
    // -- Generated
    public static string $tableName = "codes";
    public string $code_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "code_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $code_email;
    public string $code_code;
    public string $code_status;

    public array $fillable = [
        "code_email",
        "code_code",
        "code_status",
    ];

    // ----
}
