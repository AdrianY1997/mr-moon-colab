<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Foxy\Database;

use FoxyMVC\Lib\Foxy\Database\MySQL;
use PDOException;

class Table {
    public Model $model;

    public static string $tableName = "";
    
    protected static string $selectText = "*";
    protected static string $whereText = "";
    protected static string $orderByText = "";
    protected static string $limitText = "";
    protected static array $exWhereArray = [];

    public static function select() {
        self::$selectText = implode(", ", func_get_args());
        return new static;
    }

    public static function where() {
        $column = func_get_arg(0);
        if (func_num_args() > 2) {
            $comparator = func_get_arg(1);
            $value = func_get_arg(2);
        } else {
            $comparator = "=";
            $value = func_get_arg(1);
        }

        array_push(self::$exWhereArray, $value);
        self::$whereText .= self::$whereText ? " AND $column $comparator ?" : " WHERE $column $comparator ?";

        return new static;
    }

    public static function orWhere() {
        $column = func_get_arg(0);
        if (func_num_args() > 2) {
            $comparator = func_get_arg(1);
            $value = func_get_arg(2);
        } else {
            $comparator = "=";
            $value = func_get_arg(1);
        }

        array_push(self::$exWhereArray, $value);
        self::$whereText .= self::$whereText ? " OR $column $comparator ?" : " WHERE $column $comparator ?";

        return new static;
    }

    public static function orderBy(string $column, string $mode) {
        self::$orderByText = self::$orderByText ? ", $column $mode" : " ORDER BY $column $mode";
        return new static;
    }

    public static function limit($limit) {
        self::$limitText = " LIMIT $limit";
        return new static;
    }

    public static function name(string $tableName) {
        self::$tableName = $tableName;
        return new static;
    }

    public static function get() {
        $values = self::$exWhereArray;
        $sentence = "SELECT " . self::$selectText . " FROM " . static::$tableName . self::$whereText . self::$orderByText . self::$limitText;
        self::reset();
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute($values);

            $items = [];

            while ($item = $stmt->fetchObject()) {
                $obj = new static;
                $id = null;
                foreach (get_object_vars($item) as $key => $column) {
                    $obj->$key = strval($column);
                    if (strpos($key, "_id")) $id = $key;
                };
                $obj->model = new Model($obj);
                array_push($items, $obj);
            }

            $stmt->closeCursor();
            return $items;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public static function first() {
        $item = self::limit(1)->get();
        return isset($item[0]) ? $item[0] : false;
    }

    /**
     * Insert data in Database Table
     * @param mixed $data
     * @return bool
     */
    public static function insert(...$models) {
        $columns = $values = "";
        $executeArray = [];

        foreach ($models as $model) {
            $columns = "(" . implode(", ", array_values($model->fillable)) . ")";
            if ($values) {
                $values .= ", (" . rtrim(str_repeat("?, ", count($model->fillable)), ", ") . ")";
            } else {
                $values = "(" . rtrim(str_repeat("?, ", count($model->fillable)), ", ") . ")";
            }
            foreach ($model->fillable as  $property) {
                array_push($executeArray, $model->$property);
            }
        }

        $sentence = "INSERT INTO " . static::$tableName . " $columns VALUES $values";
        self::reset();
        try {
            $pdo = MySQL::connect();
            $stmt = $pdo->prepare($sentence);
            $stmt->execute($executeArray);
            return $pdo->lastInsertId();
        } catch (PDOException $ex) {
            return false;
        }
    }

    public static function update(array $data) {
        $values = self::$exWhereArray;
        $setText = implode(", ", array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $sentence = "UPDATE " . static::$tableName . " SET " . $setText . self::$whereText . self::$orderByText . self::$limitText;
        self::reset();
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute(array_merge(array_values($data), array_values($values)));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete() {
        $values = self::$exWhereArray;
        $sentence = "DELETE FROM " . static::$tableName . self::$whereText . self::$orderByText . self::$limitText;
        var_dump($sentence);
        self::reset();
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute(array_values($values));
            return true;
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    private static function reset() {
        self::$selectText = "*";
        self::$whereText = "";
        self::$orderByText = "";
        self::$limitText = "";
        self::$exWhereArray = [];
    }
}