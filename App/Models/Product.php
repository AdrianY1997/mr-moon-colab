<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class Product extends Table {
    // -- Generated
    protected static string $tableName = "products";
    public string $prod_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "prod_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $prod_ref;
    public string $prod_name;
    public string $prod_desc;
    public string $prod_stock;
    public string $prod_value;

    protected array $fillable = [
        "prod_ref",
        "prod_name",
        "prod_desc",
        "prod_stock",
        "prod_value",
    ];

    // ----
}