<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Foxy\Database;

use PDOException;

class Model {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function insert() {

        $tableName = $this->model::$tableName;

        $columns = [];
        $values = [];

        foreach($this->model->fillable as $key => $value) {
            array_push($columns, $key);
            array_push($values, $this->model->{$key});
        }

        $columnsText = implode(", ", $columns);
        $valuesText = substr(str_repeat("?, ", count($values)), 0, -strlen(", "));

        $sentence = "INSERT INTO $tableName ($columnsText) VALUES ($valuesText)";

        try {
            $con = MySQL::connect();
            $stmt = $con->prepare($sentence);
            $stmt->execute($values);
            return $con->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
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
            $stmt->execute([...$executeValues, $this->model->{substr($this->model::$tableName, 0, 4) . "_id"}]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete() {
        $tableName = $this->model::$tableName;
        $idValue = substr($this->model::$tableName, 0, 4) . "_id";

        $sentence = "DELETE FROM $tableName WHERE id = ?";
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute([$idValue]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
