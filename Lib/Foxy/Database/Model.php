<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Foxy\Database;

use PDOException;

class Model {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function update() {
        $setText = array_map(function ($key) {
            return $this->model->fillable[$key] . " = ?";
        }, array_keys($this->model->fillable));
        $executeValues = array_map(function ($key) {
            return $this->model->{$this->model->fillable[$key]};
        }, array_keys($this->model->fillable));

        $sentence = "UPDATE " . $this->model::$tableName . " SET " . implode(", ", $setText) . " WHERE " . substr($this->model::$tableName, 0, 4) . "_id = ?";
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute([...$executeValues, $this->model->user_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
