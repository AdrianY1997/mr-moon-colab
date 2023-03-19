<?php

namespace Lib\Cli\Command\Migration;

use Lib\Cli\Command\Database\Create;
use Lib\Cli\Core\Base\Command;
use PDO;

class Migrate extends Command
{
    public function __construct($pro, $avs)
    {
        parent::__construct($pro, $avs);
    }

    public function init()
    {
        $migrationsFolder = "App\\Site\\Migrations";

        $name = constant('DBNAME');
        $host = constant('DBHOST');
        $user = constant('DBUSER');
        $pass = constant('DBPASS');
        $port = constant('DBPORT');
        $chst = constant('DBCHST');

        $pdo = new PDO("mysql:host=$host;port=$port,charset=$chst", $user, $pass);

        $migrationFiles = glob(constant("DIR") . '\\App\\Site\\Migrations\\*.php');

        $database = new Create();
        $database->init();

        $pdo->exec("USE $name;");

        foreach ($migrationFiles as $migrationFile) {
            $migration = require_once $migrationFile;

            $pdo->exec($migration->up());
        }
    }
}
