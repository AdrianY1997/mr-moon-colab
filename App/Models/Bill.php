<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

class Bill extends Table {
    // -- Generated
    public static string $tableName = "bills";
    public Model $model;
    public string $bill_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "bill_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $bill_serial;
    public string $bill_date;
    public string $bill_total;
    public string $user_id;

    public array $fillable = [
        "bill_serial",
        "bill_date",
        "bill_total",
        "user_id",
    ];

    // ----
}
