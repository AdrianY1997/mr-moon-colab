<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Foxy\Database;

use FoxyMVC\Lib\Foxy\Database\MySQL;
use PDOException;

class Table {
    protected MySQL $db;

    protected string $tableName;
    protected string $columnText;
    protected string $whereText;
    protected string $orderByText;
    protected string $limitText;
    protected array $exWhereArray;

    public function __construct(string $tableName) {
        $this->db = new MySQL();
        $this->tableName = $tableName;
        $this->columnText = "*";
        $this->whereText = "";
        $this->orderByText = "";
        $this->limitText = "";

        $this->exWhereArray = [];
    }

    public function select() {
        $this->columnText = implode(", ", func_get_args());
        return $this;
    }

    public function where() {
        $column = func_get_arg(0);
        if (func_num_args() > 2) {
            $comparator = func_get_arg(1);
            $value = func_get_arg(2);
        } else {
            $comparator = "=";
            $value = func_get_arg(1);
        }

        array_push($this->exWhereArray, $value);
        $this->whereText .= $this->whereText ? " AND $column $comparator ?" : " WHERE $column $comparator ?";

        return $this;
    }

    public function orWhere() {
        $column = func_get_arg(0);
        if (func_num_args() > 2) {
            $comparator = func_get_arg(1);
            $value = func_get_arg(2);
        } else {
            $comparator = "=";
            $value = func_get_arg(1);
        }

        array_push($this->exWhereArray, $value);
        $this->whereText .= $this->whereText ? " OR $column $comparator ?" : " WHERE $column $comparator ?";

        return $this;
    }

    public function orderBy(string $column, string $mode) {
        $this->orderByText = $this->orderByText ? ", $column $mode" : " ORDER BY $column $mode";
        return $this;
    }

    public function limit($limit = null) {
        $this->limitText = " LIMIT $limit";
        return $this;
    }

    public function insert(array $data) {
        $tableName = $this->tableName;
        $columns = implode(", ", array_keys($data));
        $values = rtrim(str_repeat("?, ", count($data)), ", ");
        $sentence = "INSERT INTO $tableName ($columns) VALUES ($values)";
        try {
            $stmt = $this->db->connect()->prepare($sentence);
            $stmt->execute(array_values($data));
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public function get() {
        $columnText = $this->columnText;
        $tableName = $this->tableName;
        $whereText = $this->whereText;
        $orderByText = $this->orderByText;
        $limitText = $this->limitText;

        $sentence = "SELECT $columnText FROM $tableName$whereText$orderByText$limitText";
        try {
            $stmt = $this->db->connect()->prepare($sentence);
            $stmt->execute($this->exWhereArray);

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

    public function first() {
        $item = $this->limit(1)->get();
        return $item[0] ?: false;
    }

    public function update(array $data) {
        $tableName = $this->tableName;
        $WhereText = $this->whereText;
        $orderByText = $this->orderByText;
        $limitText = $this->limitText;

        $setText = implode(", ", array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $sentence = "UPDATE $tableName SET $setText$WhereText$orderByText$limitText";
        try {
            $stmt = $this->db->connect()->prepare($sentence);
            $stmt->execute(array_merge(array_values($data), array_values($this->exWhereArray)));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete() {
        $tableName = $this->tableName;
        $whereText = $this->whereText;
        $orderByText = $this->orderByText;
        $limitText = $this->limitText;

        $sentence = "DELETE FROM $tableName$whereText$orderByText$limitText";
        try {
            $stmt = $this->db->connect()->prepare($sentence);
            $stmt->execute(array_values($this->exWhereArray));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    private static function name(string $tableName) {
        return new self($tableName);
    }
}