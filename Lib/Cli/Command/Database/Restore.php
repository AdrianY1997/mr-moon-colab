<?php

namespace Lib\Cli\Command\Database;

use Lib\Cli\Core\Base\Command;
use PDO;

class Restore extends Command
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
        $dump = getenv("DBFILE");

        $backupsFolder = constant("DIR") . "/Database/Backup";
        $backupArray = glob($backupsFolder . "/*.php");
        $backupLast = $backupArray[array_key_last($backupArray)];

        $pdo = new PDO("mysql:host=$host;port=$port,charset=$chst", $user, $pass);

        $this->printer->display("info", "Comprobando si existe una la base de datos");
        $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$name'");

        if ($stmt->fetchColumn()) {
            $this->printer->display("succ", "La base de datos existe.");

            $this->printer->display("info", "Iniciando Restauración.");
            exec("$dump -h $host -u $user -p $pass -P $port $name < $backupLast");
            $this->printer->display("info", "Copia de seguridad restaurada (?");
        } else {
            $this->printer->display("warn", "No existe la base de datos");
            $this->printer->display("warn", "Saliendo...\n");
        }
    }
}
