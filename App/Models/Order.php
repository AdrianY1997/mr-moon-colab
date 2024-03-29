<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class Order extends Table {
    // -- Generated
    public static string $tableName = "orders";
    public Model $model;
    public string $orde_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "orde_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $orde_quantity;
    public string $bill_id;
    public string $prod_id;

    public array $fillable = [
        "orde_quantity",
        "bill_id",
        "prod_id",
    ];

    // ----
}
