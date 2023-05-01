<?php

namespace FoxyMVC\Lib\Cli\Command\Migration;

use FoxyMVC\Lib\Cli\Command\Database\Create;
use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase para migrar la base de datos
 */
class Migrate extends Command {
    /**
     * Constructor de la clase Backup
     *
     * @param array $pro Propiedades
     * @param array $avs Argumentos
     */
    public function __construct($pro, $avs) {
        parent::__construct($pro, $avs);
    }

    /**
     * Inicializa la migración
     *
     * @return void
     */
    public function init() {
        // Obtiene los archivos en la carpeta de migraciones
        $migrationsFolder = constant("DIR") . "/Database/Migrations/*.php";
        $migrationFiles = glob($migrationsFolder);

        // Crear una instancia de la clase Create del comando database:create y la inicializa
        $database = new Create();
        $database->init();

        // Recorrer cada archivo de migración y ejecutar el método up si existe
        foreach ($migrationFiles as $migrationFile) {
            $migration = require_once $migrationFile;

            if (method_exists($migration, "up")) {
                $migration->up();
            }
        }
    }
}
