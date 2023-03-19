<?php

namespace Lib\Cli\Command\Database;

use DateTime;
use DateTimeZone;
use Lib\Cli\Core\Base\Command;
use PDO;

class Backup extends Command
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
        $dump = constant("DPFILE");

        $backupsFolder = constant("DIR") . "Database/Backup";

        mkdir($backupsFolder);

        $date = new DateTime('now', new DateTimeZone('America/Bogota'));
        $output = $backupsFolder . "/" . $date->format("Y-m-d_Hisu") . ".php";

        $pdo = new PDO("mysql:host=$host;port=$port,charset=$chst", $user, $pass);

        $this->printer->display("info", "Comprobando si existe una la base de datos");
        $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$name'");

        if ($stmt->fetchColumn()) {
            $this->printer->display("succ", "La base de datos existe.");

            $this->printer->display("info", "Iniciando Copia de seguridad");
            exec("$dump --opt -h $host -u $user -p $pass -P $port $name > $output");
            $this->printer->display("info", "Copia de seguridad completa (?");
        } else {
            $this->printer->display("warn", "No existe la base de datos");
            $this->printer->display("warn", "Saliendo...\n");
        }
    }
}
