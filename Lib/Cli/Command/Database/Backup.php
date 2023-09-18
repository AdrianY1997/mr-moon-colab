<?php

namespace FoxyMVC\Lib\Cli\Command\Database;

use DateTime;
use DateTimeZone;
use FoxyMVC\Lib\Cli\Core\Base\Connection;

/**
 * Clase para realizar copias de seguridad de la base de datos
 */
class Backup extends Connection {
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
     * Inicializa el proceso de copia de seguridad
     *
     * @return void
     */
    public function init() {
        // Crear la carpeta para almacenar las copias de seguridad
        $backupsFolder = "Database/Backup";
        mkdir($backupsFolder);

        // Generar el nombre del archivo de salida con la fecha y hora actual
        $date = new DateTime('now', new DateTimeZone('America/Bogota'));
        $output = $backupsFolder . "/" . $date->format("Y-m-d_Hisu") . ".sql";

        // Comprobar si existe la base de datos
        $this->printer->display("info", "Comprobando si existe una la base de datos");
        $stmt = $this->pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->name . "'");

        if ($stmt->fetchColumn()) {
            // Si existe la base de datos, realizar la copia de seguridad
            $this->printer->display("succ", "La base de datos existe.");
            $this->printer->display("info", "Iniciando Copia de seguridad");
            $exec = "\"" . $this->dpfl . "\" --opt --host=" . $this->host . " --user=" . $this->user . " --password=" . $this->pass . " --port=" . $this->port . " " . $this->name . " > \"$output\"";
            // var_dump($exec);
            !exec($exec);
            $this->printer->display("succ", "Copia de seguridad completa");
            $this->printer->display("succ", "Saliendo...\n");
        } else {
            // Si no existe la base de datos, mostrar un mensaje y salir
            $this->printer->display("warn", "No existe la base de datos");
            $this->printer->display("warn", "Saliendo...\n");
        }
    }
}
