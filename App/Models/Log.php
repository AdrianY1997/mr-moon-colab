<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class Log extends Table {
    // -- Generated
    public static string $tableName = 'logs';
    public Model $model;
    public string $logs_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "logs_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $logs_tableName;

    public string $logs_params;

    public string $logs_action;

    public array $fillable = [
        "logs_tableName",
        "logs_params",
        "logs_action",
    ];

    // ----
}
