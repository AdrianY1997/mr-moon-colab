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
        $migrationsFolder = constant("DIR") . "/Database/Migrations/*.php";
        $migrationFiles = glob($migrationsFolder);

        $database = new Create();
        $database->init();

        foreach ($migrationFiles as $migrationFile) {
            $migration = require_once $migrationFile;

            if (method_exists($migration, "up")) {
                $migration->up();
            }
        }
    }
}
