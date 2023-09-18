<?php

namespace FoxyMVC\Lib\Cli\Command\Database;

use FoxyMVC\Lib\Cli\Core\Base\Connection;

/**
 * Clase para restaurar copias de seguridad de la base de datos
 */
class Restore extends Connection {
    /**
     * Constructor de la clase Backup
     *
     * @param array $pro Propiedades
     * @param array $avs Argumentos
     */
    public function __construct($pro = [], $avs = []) {
        parent::__construct($pro, $avs);
    }


    /**
     * Inicializa el proceso de restauración de la base de datos
     *
     * @return void
     */
    public function init() {
        // Buscar la carpeta donde se almacenan las copias de seguridad y selecciona la ultima
        $backupsFolder = constant("DIR") . "/Database/Backup";
        $backupArray = glob($backupsFolder . "/*.sql");
        $backupLast = $backupArray[array_key_last($backupArray)];


        // Comprobar si existe la base de datos
        $this->printer->display("info", "Comprobando si existe una la base de datos");
        $stmt = $this->pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->name . "'");

        if ($stmt->fetchColumn()) {
            // Si existe la base de datos, realizar la restauración
            $this->printer->display("succ", "La base de datos existe.");
            $this->printer->display("info", "Iniciando Restauración.");
            $exec = "\"" . $this->dpfl . "\" --opt --host=" . $this->host . " --user=" . $this->user . " --password=" . $this->pass . " --port=" . $this->port . " " . $this->name . " > \"$backupLast\"";
            // var_dump($exec);
            exec($exec);
            $this->printer->display("succ", "Copia de seguridad restaurada");
            $this->printer->display("succ", "Saliendo...\n");
        } else {
            // Si no existe la base de datos, mostrar un mensaje y salir
            $this->printer->display("warn", "No existe la base de datos");
            $this->printer->display("warn", "Saliendo...\n");
        }
    }
}
