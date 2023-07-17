<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class Menu extends Table {
    // -- Generated
    protected static string $tableName = "menus";
    public string $menu_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "menu_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns
    public string $menu_name;
    public string $menu_path;

    protected array $fillable = [
        "menu_name",
        "menu_path",
    ];

    // ----
}
