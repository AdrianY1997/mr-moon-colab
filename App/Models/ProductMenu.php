<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class ProductMenu extends Table {
    // -- Generated
    protected static string $tableName = "product_menu";
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $prod_id;
    public string $menu_id;

    protected array $fillable = [
        "prod_id",
        "menu_id",
    ];

    // ----
}