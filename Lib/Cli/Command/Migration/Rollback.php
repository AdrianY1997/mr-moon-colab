<?php

namespace FoxyMVC\Lib\Cli\Command\Migration;

use FoxyMVC\Lib\Cli\Command\Database\Drop;
use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase para migrar la base de datos
 */
class Rollback extends Command {
    /**
     * Constructor de la clase Rollback
     *
     * @param array $pro Propiedades
     * @param array $avs Argumentos
     */
    public function __construct($pro, $avs) {
        parent::__construct($pro, $avs);
    }

    /**
     * Inicializa la eliminación
     *
     * @return void
     */
    public function init() {
        // Obtiene los archivos en la carpeta de migraciones
        $migrationsFolder = constant("DIR") . "/Database/Migrations/*.php";
        $migrationFiles = glob($migrationsFolder);

        // Crear una instancia de la clase Drop del comando database:drop y la inicializa
        $database = new Drop();
        $database->init();
    }
}
