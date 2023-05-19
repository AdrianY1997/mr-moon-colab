<?php

namespace FoxyMVC\Lib\Foxy\Database\Schema;

class Blueprint {
    protected $columns = [];

    protected $tableName;
    protected $acronym;

    public function __construct(string $tableName) {
        $this->tableName = $tableName;
        $this->acronym = substr($tableName, 0, 4) . "_";
    }

    public function isManyToMany() {
        $this->acronym = "";
    }

    public function id() {
        $this->columns[] = $this->acronym . "id INT AUTO_INCREMENT PRIMARY KEY";
    }

    // Data types

    public function integer(string $columnName) {
        $this->addColumn($this->acronym . $columnName, 'INT');
        return $this;
    }

    public function string(string $columnName) {
        $this->addColumn($this->acronym . $columnName, 'VARCHAR(255)');
        return $this;
    }

    public function text(string $columnName) {
        $this->addColumn($this->acronym . $columnName, 'TEXT');
        return $this;
    }

    public function references(string $tableName) {
        $pos = strpos($this->columns[array_key_last($this->columns)], $this->acronym);
        if ($pos !== false) {
            $this->columns[array_key_last($this->columns)] = substr_replace($this->columns[array_key_last($this->columns)], "", $pos, strlen($this->acronym));
        }
        $column = explode(" ", $this->columns[array_key_last($this->columns)])[0];
        $this->addColumn("FOREIGN KEY ($column) REFERENCES $tableName($column)");
    }

    public function timestamp(string $columnName, bool $acronym = true) {
        $this->addColumn(($acronym ? $this->acronym : "") . $columnName, 'TIMESTAMP');
        return $this;
    }

    // Properties

    public function unique() {
        $this->columns[array_key_last($this->columns)] .= ' UNIQUE';
        return $this;
    }

    public function default($default, $string = false) {
        $this->columns[array_key_last($this->columns)] .= ' DEFAULT ' . ($string ? '\'' . $default . '\'' : $default);
        return $this;
    }

    public function update($update, $string = false) {
        $this->columns[array_key_last($this->columns)] .= ' ON UPDATE ' . ($string ? '\'' . $update . '\'' : $update);
        return $this;
    }

    protected function addColumn(string $columnName, string $type = "", $options = []) {
        $this->columns[] = "$columnName $type" . $this->formatOptions($options);
    }

    protected function formatOptions($options) {
        if (empty($options)) {
            return '';
        }

        $options = array_map(function ($key, $value) {
            return "$key=$value";
        }, array_keys($options), $options);

        return ' ' . implode(' ', $options);
    }

    public function getColumns() {
        return $this->columns;
    }
}