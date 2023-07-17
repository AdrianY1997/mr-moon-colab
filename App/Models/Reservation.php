<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

class Reservation extends Table {
    // -- Generated
    protected static string $tableName = "reservations";
    public string $rese_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "rese_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $rese_urid;
    public string $rese_name;
    public string $rese_lastname;
    public string $rese_email;
    public string $rese_quantity;
    public string $rese_table;
    public string $rese_date;
    public string $rese_time;
    public string $rese_status;
    public string $user_id;

    protected array $fillable = [
        "rese_urid",
        "rese_name",
        "rese_lastname",
        "rese_email",
        "rese_quantity",
        "rese_table",
        "rese_date",
        "rese_time",
        "rese_status",
        "user_id",
    ];

    // ----
}