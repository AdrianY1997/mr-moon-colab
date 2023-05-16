<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Foxy\Database;

use FoxyMVC\Lib\Foxy\Database\MySQL;
use PDOException;

class Table {
    protected static string $tableName = "";
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
        $sentence = "SELECT " . self::$selectText . " FROM " . (self::$tableName ?: static::$table) . self::$whereText . self::$orderByText . self::$limitText;
        self::reset();
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute($values);

            $items = [];

            while ($item = $stmt->fetchObject()) {
                array_push($items, $item);
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

    public static function insert(array $data) {
        $columns = implode(", ", array_keys($data));
        $values = rtrim(str_repeat("?, ", count($data)), ", ");
        $sentence = "INSERT INTO " . (self::$tableName ?: static::$table) . " ($columns) VALUES ($values)";
        self::reset();
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute(array_values($data));
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public static function update(array $data) {
        $values = self::$exWhereArray;
        $setText = implode(", ", array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $sentence = "UPDATE " . (self::$tableName ?: static::$table) . " SET " . $setText . self::$whereText . self::$orderByText . self::$limitText;
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
        $sentence = "DELETE FROM " . (self::$tableName ?: static::$table) . self::$whereText . self::$orderByText . self::$limitText;
        self::reset();
        try {
            $stmt = MySQL::connect()->prepare($sentence);
            $stmt->execute(array_values($values));
            return true;
        } catch (PDOException $e) {
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
