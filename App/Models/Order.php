<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class Order extends Table {
    // -- Generated
    protected static string $tableName = "orders";
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

    protected array $fillable = [
        "orde_quantity",
        "bill_id",
        "prod_id",
    ];

    // ----
}