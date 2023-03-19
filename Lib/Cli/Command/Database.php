<?php

namespace Lib\Cli\Command;

use Lib\Cli\Base\Command;
use Lib\Foxy\Core\Database as FoxyDatabase;

class Database extends Command
{
    public function __construct($app, $argv)
    {
        parent::__construct($app, $argv);

        $methods = [
            "migrate",
            "update",
            "delete"
        ];

        $this->printer->display("info", "Obteniendo acción");
        $action = isset($argv[2]) ? $argv[2] : null;



        if (!method_exists($this, $action))
            $this->printer->error(
                "La acción ingresada no se puede ejecutar",
                "Modo de uso:",
                "$ php foxy database [acción] [--options]",
                "[acción]: migrate | update | delete",
                "[--options]: blank"
            );

        $this->printer->display("succ", "Componente: $action");
        $this->{$argv[2]}($argv);
    }

    public function migrate($argv)
    {
        $path = "App\\Migrations";
        $files = scandir($path);

        $stmt = (new FoxyDatabase())->connect(["dbname" => ""])->prepare("DROP DATABASE IF EXISTS " . constant("DBNAME"));
        $stmt->execute([]);
        $stmt->closeCursor();

        $stmt = (new FoxyDatabase())->connect(["dbname" => ""])->prepare("CREATE DATABASE " . constant("DBNAME"));
        $stmt->execute([]);
        $stmt->closeCursor();

        $stmt = (new FoxyDatabase())->connect(["dbname" => ""])->prepare("USE " . constant("DBNAME"));
        $stmt->execute([]);
        $stmt->closeCursor();

        foreach ($files as $key => $file) {

            if ($file == "." || $file == "..") continue;

            $migration = require_once $path . "\\" . $file;
            $query = $migration->up();

            $stmt = (new FoxyDatabase())->connect()->prepare($query);
            $stmt->execute();
            $stmt->closeCursor();
        }
    }
}
