<?php

namespace Lib\Foxy\Core;

class Blueprint
{
    const TEMPLATE = [
        "name" => "",
        "dType" => [
            "type" => "",
            "limit" => "",
        ],
        "attributes" => [
            "name" => "",
            "action" => ""
        ],
        "collate" => "",
        "null" => "",
        "default" => "",
        "ai" => "",
        "primary" => ""
    ];

    protected $name;

    protected $query = [];

    public function __construct()
    {
    }

    public function id($name)
    {
        $this->name = $name;

        array_push($this->query, [
            "name" => "id",
            "dType" => [
                "type" => "INT",
                "limit" => "",
            ],
            "attributes" => [
                "name" => "",
                "action" => ""
            ],
            "collate" => "",
            "null" => " NOT NULL",
            "default" => "",
            "ai" => " AUTO_INCREMENT",
            "primary" => " PRIMARY KEY"
        ]);

        return $this;
    }

    public function string($name, $limit = null)
    {
        array_push($this->query, self::TEMPLATE);
        $this->query[array_key_last($this->query)]["name"] = $name;
        $this->query[array_key_last($this->query)]["dType"]["type"] = " VARCHAR";
        $this->query[array_key_last($this->query)]["dType"]["limit"] = $limit ? " ($limit)" : "(255)";

        return $this;
    }

    public function notNull()
    {
        $this->query[array_key_last($this->query)]["null"] = false;

        return $this;
    }

    public function create()
    {
        $name = $this->name;

        $query = "CREATE TABLE $name (";
        foreach ($this->query as $key => $element) {

            $options = [
                substr($this->name, 0, 4) . "_" . $element["name"],
                $element["dType"]["type"] . ($element["dType"]["limit"] ? $element["dType"]["limit"] : ""),
                $element["attributes"]["name"],
                $element["collate"],
                (!$element["null"] ? "NOT NULL" : ""),
                ($element["default"] ? $element["default"] : ""),
                ($element["ai"] ? $element["ai"] : ""),
                ($element["primary"]) ? $element["primary"] : "",
            ];

            $column = preg_replace('/\s+/', ' ', trim(join(" ", $options)) . (!$key == count($this->query) - 1 ? ", " : ""));

            $query .= $column;
        }
        $query .= ");";

        return $query;
    }
}
