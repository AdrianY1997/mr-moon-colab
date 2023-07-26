<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class Menu extends Table {
    // -- Generated
    public static string $tableName = "menus";
    public Model $model;
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

    public array $fillable = [
        "menu_name",
        "menu_path",
    ];

    // ----
}
