<?php

namespace Lib\Cli\Command\Migration;

use Lib\Cli\Command\Database\Create;
use Lib\Cli\Command\Database\Drop;
use Lib\Cli\Core\Base\Command;
use PDO;

class Rollback extends Command
{
    public function __construct($pro, $avs)
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

        $migrationFiles = glob(constant("DIR") . '\\App\\Site\\Migrations\\*.php');
        $pdo->exec("USE $name;");

        foreach ($migrationFiles as $key => $migrationFile) {
            $migration = require_once $migrationFile;

            $pdo->exec($migration->down());
        }

        $database = new Drop();
        $database->init();
    }
}
