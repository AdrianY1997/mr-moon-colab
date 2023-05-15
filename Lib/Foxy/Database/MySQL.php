<?php

namespace FoxyMVC\Lib\Foxy\Database;

use PDO;
use PDOException;


class MySQL {
    public const LOG_INSERT = "insert";
    public const LOG_UPDATE = "update";

    static $connection = [];

    /**
     * Realiza la conexión a la base de datos
     * 
     * @return PDO|string Retorna la conexión a la base de datos o Imprime una excepción
     */
    public static function connect($options = []) {
        $host = constant('DBHOST');
        $name = constant('DBNAME');
        $user = constant('DBUSER');
        $pass = constant('DBPASS');
        $port = constant("DBPORT");
        $chst = constant("DBCHST");

        $db_name = ";dbname=" . $name;

        if (isset($options["dbname"]) && !$options["dbname"]) {
            $db_name = "";
        }

        try {
            $connection = "mysql:host=" . $host . $db_name . ";port=" . $port . ";charset=" . $chst;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($connection, $user, $pass, $options);

            self::$connection[] = $pdo;

            return $pdo;
        } catch (PDOException $e) {
            return print_r('Error connection: ' . $e->getMessage());
        }
    }

    public function drop($name) {
        $stmt = $this->connect()->prepare("DROP TABLE ?");
        $stmt->execute([$name]);
    }

    public static function closeConnection() {
        foreach (self::$connection as $pdo) {
            $pdo = null;
        }
        self::$connection = [];
    }
}