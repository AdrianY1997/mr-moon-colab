<?php

namespace Lib\Foxy\Core;

use PDO;
use PDOException;


class Database
{
    private $host;
    private $name;
    private $user;
    private $pass;
    private $port;
    private $chst;

    protected $test;

    static $connection = [];

    function __construct()
    {
        $this->host = constant('DBHOST');
        $this->name = constant('DBNAME');
        $this->user = constant('DBUSER');
        $this->pass = constant('DBPASS');
        $this->port = constant("DBPORT");
        $this->chst = constant("DBCHST");
    }

    /**
     * Realiza la conexión a la base de datos
     * 
     * @return PDO|string Retorna la conexión a la base de datos o Imprime una excepción
     */
    function connect($options = []): PDO|string
    {
        $db_name = ";dbname=" . $this->name;

        if (isset($options["dbname"]) && !$options["dbname"]) {
            $db_name = "";
        }

        try {
            $connection = "mysql:host=" . $this->host . $db_name . ";port=" . $this->port . ";charset=" . $this->chst;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($connection, $this->user, $this->pass, $options);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$connection[] = $pdo;

            return $pdo;
        } catch (PDOException $e) {
            return print_r('Error connection: ' . $e->getMessage());
        }
    }

    public function drop($name)
    {
        $stmt = $this->connect()->prepare("DROP TABLE ?");
        $stmt->execute([$name]);
    }

    public static function closeConnection()
    {
        foreach (self::$connection as $pdo) {
            $pdo = null;
        }
        self::$connection = [];
    }
}
