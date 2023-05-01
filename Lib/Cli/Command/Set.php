<?php

namespace FoxyMVC\Lib\Cli\Command;

use FoxyMVC\Lib\Cli\Core\Register;

/**
 * Clase donde se asignan los comandos
 */
class Set {
    /**
     * Inicializa la clase
     *
     * @return void
     */
    public function init() {
        Register::command("make",  [
            "controller",
            "migration",
            "model"
        ]);

        Register::command("migration", [
            "run",
        ]);

        Register::command("server", [
            "start"
        ]);

        Register::command("database", [
            "backup",
            "create",
            "drop",
            "restore"
        ]);
    }
};
