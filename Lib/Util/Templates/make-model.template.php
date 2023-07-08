<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class __model extends Table {
  // -- Generated
  protected static string $tableName = '__tableName';
  public string $__tableName_id;
  public string $created_at;
  public string $updated_at;
  protected array $hidden = [
    "__tableName_id",
    "created_at",
    "updated_at"
  ];
  // ----

  // -- Here the columns

  protected array $fillable = [

  ];

  // ----
}