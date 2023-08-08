<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class Galeria extends Table {
  // -- Generated
  public static string $tableName = 'galerias';
  public Model $model;
  public string $gale_id;
  public string $created_at;
  public string $updated_at;
  protected array $hidden = [
    "gale_id",
    "created_at",
    "updated_at"
  ];
  // ----

  // -- Here the columns

  
  public string $gale_name;
  public string $gale_path;

  public array $fillable = [
    "gale_name",
    "gale_path",
  ];

  // ----
}
