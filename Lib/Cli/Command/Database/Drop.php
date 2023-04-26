<?php

namespace FoxyMVC\Lib\Cli\Command\Database;

use FoxyMVC\Lib\Cli\Core\Base\Connection;

/**
 * Clase para borrar la base de datos
 */
class Drop extends Connection {
    /**
     * Constructor de la clase Drop
     *
     * @param array $pro propiedades
     * @param array $avs argumentos
     */
    public function __construct($pro = [], $avs = []) {
        parent::__construct($pro, $avs);
    }

    /**
     * Inicializa el proceso de eliminación de la base de datos
     *
     * @return void
     */
    public function init() {
        // Comprobar si existe la base de datos
        $this->printer->display("info", "Comprobando si existe la base de datos");
        $stmt = $this->pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->name . "'");

        if ($stmt->fetchColumn()) {
            // Si existe la base de datos, eliminarla
            $this->printer->display("info", "La base de datos existe en el sistema");
            $this->printer->display("info", "Eliminando...");
            $this->pdo->exec("DROP DATABASE " . $this->name);
            $this->printer->display("succ", "La base de datos ha sido eliminada");
        } else {
            // Si no existe la base de datos, mostrar un mensaje y salir
            $this->printer->display("warn", "La base de datos aun no ha sido creada");
            $this->printer->display("warn", "Saliendo...\n");
        }
    }
}
