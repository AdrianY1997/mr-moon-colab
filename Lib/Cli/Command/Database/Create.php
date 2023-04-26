<?php

namespace FoxyMVC\Lib\Cli\Command\Database;

use FoxyMVC\Lib\Cli\Core\Base\Connection;

/**
 * Clase para crear una base de datos
 */
class Create extends Connection {
    /**
     * Constructor de la clase Create
     *
     * @param array $pro Propiedades
     * @param array $avs Argumentos
     */
    public function __construct($pro = [], $avs = []) {
        parent::__construct($pro, $avs);
    }

    /**
     * Inicializa el proceso de creación de la base de datos
     *
     * @return void
     */
    public function init() {
        // Comprobar si existe una base de datos con el mismo nombre
        $this->printer->display("info", "Comprobando si existe una base de datos con el mismo nombre");
        $stmt = $this->pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->name . "'");

        if ($stmt->fetchColumn()) {
            // Si existe una base de datos con el mismo nombre, mostrar un mensaje y salir
            $this->printer->display("warn", "La base de datos ya existe.");
        } else {
            // Si no existe una base de datos con el mismo nombre, crearla y mostrar un mensaje
            $this->printer->display("info", "La base de datos no existe en el sistema");
            $this->printer->display("info", "Creando...");
            $this->pdo->exec("CREATE DATABASE " . $this->name);
            $this->printer->display("succ", "La base de datos ha sido creada correctamente");
            $this->printer->display("succ", "Saliendo...\n");
        }
    }
}
