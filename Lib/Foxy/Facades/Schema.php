<?php

namespace Lib\Foxy\Facades;

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

        self::$pdo = new PDO("mysql:host=$host;port=$port;dbname=$name;charset=$chst", $user, $pass, $options);
    }

    static function create(string $tableName, callable $blueprint)
    {
        self::connect();

        $blueprintObj = new Blueprint($tableName);
        $blueprint($blueprintObj);

        $blueprintObj->timestamp("created_at", false)->default("CURRENT_TIMESTAMP");
        $blueprintObj->timestamp("updated_at", false)->default("CURRENT_TIMESTAMP")->update("CURRENT_TIMESTAMP");

        $sql = "CREATE TABLE IF NOT EXISTS $tableName (" . implode(", ", $blueprintObj->getColumns()) . ")";
        self::$pdo->exec($sql);
    }

    static function query($query)
    {
        self::$pdo->exec($query);
    }

    static function dropIfExists($tableName)
    {
        self::connect();
        self::$pdo->exec("DROP TABLE IF EXISTS $tableName");
    }
}
