<?php

namespace Lib\Foxy\Facades;

use Lib\Foxy\Database\MySQL;
use Lib\Foxy\Database\Schema\Blueprint;
use PDO;

class Schema
{
    protected static $pdo;

    static function connect()
    {
        $host = constant('DBHOST');
        $user = constant('DBUSER');
        $pass = constant('DBPASS');
        $port = constant('DBPORT');
        $name = constant("DBNAME");
        $chst = constant('DBCHST');

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        self::$pdo = new MySQL();
    }

    static function create(string $tableName, callable $blueprint)
    {
        self::connect();

        $blueprintObj = new Blueprint($tableName);
        $blueprint($blueprintObj);

        $blueprintObj->timestamp("created_at", false)->default("CURRENT_TIMESTAMP");
        $blueprintObj->timestamp("updated_at", false)->default("CURRENT_TIMESTAMP")->update("CURRENT_TIMESTAMP");

        $sql = "CREATE TABLE IF NOT EXISTS $tableName (" . implode(", ", $blueprintObj->getColumns()) . ")";
        $stmt = self::$pdo->connect()->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();
    }

    static function insert(string $table, array $data)
    {
        self::connect();

        $keys = array_keys($data);
        $values = array_values($data);

        array_walk($keys, function (&$value) use ($table) {
            $value = substr($table, 0, 4) . "_" . $value;
        });

        $sql = "INSERT INTO $table (" . join(", ", $keys) . ") VALUES (" . rtrim(str_repeat("? ", count($data)), ", ") . ")";

        $stmt = self::$pdo->connect()->prepare($sql);
        $stmt->execute($values);
        $stmt->closeCursor();
    }

    static function dropIfExists($tableName)
    {
        $sql = "DROP TABLE IF EXISTS ?";

        $stmt = self::$pdo->connect()->prepare($sql);
        $stmt->execute([$tableName]);
        $stmt->closeCursor();
    }
}
