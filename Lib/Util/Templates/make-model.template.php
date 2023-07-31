<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class __model extends Table {
  // -- Generated
  public static string $tableName = '__tableName';
  public Model $model;
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

  public array $fillable = [];

  // ----

  public function __construct() {
    $this->model = new Model($this->hidden["__tableName_id"], $this->fillable);
  }
}
