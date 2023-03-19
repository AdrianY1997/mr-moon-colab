<?php

namespace Lib\Cli\Command\Database;

use Lib\Cli\Core\Base\Command;
use PDO;

class Create extends Command
{
    public function __construct($pro = [], $avs = [])
    {
        parent::__construct($pro, $avs);
    }

    public function init()
    {
        $name = constant('DBNAME');
        $host = constant('DBHOST');
        $user = constant('DBUSER');
        $pass = constant('DBPASS');
        $port = constant('DBPORT');
        $chst = constant('DBCHST');

        $pdo = new PDO("mysql:host=$host;port=$port,charset=$chst", $user, $pass);

        $this->printer->display("info", "Comprobando si existe una base de datos con el mismo nombre");
        $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$name'");

        if ($stmt->fetchColumn()) {
            $this->printer->display("warn", "La base de datos ya existe.");
        } else {
            $this->printer->display("info", "La base de datos no existe en el sistema");
            $this->printer->display("info", "Creando...");
            $pdo->exec("CREATE DATABASE $name");
            $this->printer->display("succ", "La base de datos ha sido creada correctamente");
            $this->printer->display("succ", "Saliendo...\n");
        }
    }
}
