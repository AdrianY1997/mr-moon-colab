<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class Event extends Table {
  // -- Generated
  protected static string $tableName = 'events';
  public string $even_id;
  public string $created_at;
  public string $updated_at;
  protected array $hidden = [
    "even_id",
    "created_at",
    "updated_at",
  ];
  // ----

  // -- Here the columns

  public string $even_fech;
  public string $even_text;
  public string $even_name;
  public string $even_path;
  protected array $fillable = [
    "even_name",
    "even_path",
    "even_text",
    "even_fech"
  ];

  // ----
}
