<?php

namespace Lib\Foxy\Database\Schema;

class Blueprint
{
    protected $columns = [];

    protected $tableName;
    protected $acronym;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
        $this->acronym = substr($tableName, 0, 4) . "_";
    }

    public function id()
    {
        $this->columns[] = $this->acronym . "id INT AUTO_INCREMENT PRIMARY KEY";
    }

    // Data types

    public function integer(string $columnName)
    {
        $this->addColumn($this->acronym . $columnName, 'INT');
        return $this;
    }

    public function string(string $columnName)
    {
        $this->addColumn($this->acronym . $columnName, 'VARCHAR(255)');
        return $this;
    }

    public function text(string $columnName)
    {
        $this->addColumn($this->acronym . $columnName, 'TEXT');
        return $this;
    }

    public function foreign(string $columnName, string $tableName)
    {
        $this->addColumn($columnName, "INT FOREIGN KEY REFERENCES $tableName($columnName)");
    }

    public function timestamp(string $columnName, bool $acronym = true)
    {
        $this->addColumn(($acronym ? $this->acronym : "") . $columnName, 'TIMESTAMP');
        return $this;
    }

    // Properties

    public function unique()
    {
        $this->columns[array_key_last($this->columns)] .= ' UNIQUE';
        return $this;
    }

    public function default($default, $string = false)
    {
        $this->columns[array_key_last($this->columns)] .= ' DEFAULT ' . ($string ? '\'' . $default . '\'' : $default);
        return $this;
    }

    public function update($update, $string = false)
    {
        $this->columns[array_key_last($this->columns)] .= ' ON UPDATE ' . ($string ? '\'' . $update . '\'' : $update);
        return $this;
    }

    protected function addColumn(string $columnName, string $type, $options = [])
    {
        $this->columns[] = "$columnName $type" . $this->formatOptions($options);
    }

    protected function formatOptions($options)
    {
        if (empty($options)) {
            return '';
        }

        $options = array_map(function ($key, $value) {
            return "$key=$value";
        }, array_keys($options), $options);

        return ' ' . implode(' ', $options);
    }

    public function getColumns()
    {
        return $this->columns;
    }
}
