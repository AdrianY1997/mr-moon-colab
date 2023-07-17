<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class ProductProvider extends Table {
    // -- Generated
    protected static string $tableName = "product_provider";
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $prod_id;
    public string $prov_id;

    protected array $fillable = [
        "prod_id",
        "prov_id",
    ];

    // ----
}