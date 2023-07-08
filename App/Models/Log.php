<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class Log extends Table {
    // -- Generated
    protected static string $tableName = 'logs';
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
    
    protected array $fillable = [
        "logs_tableName",
        "logs_params",
        "logs_action",
    ];
    
    // ----
}
