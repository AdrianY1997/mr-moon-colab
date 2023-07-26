<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class ProductMenu extends Table {
    // -- Generated
    public static string $tableName = "product_menu";
    public Model $model;
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

    public array $fillable = [
        "prod_id",
        "menu_id",
    ];

    // ----
}
