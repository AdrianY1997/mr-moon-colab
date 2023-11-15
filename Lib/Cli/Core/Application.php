<?php

namespace FoxyMVC\Lib\Cli\Core;

use FoxyMVC\Lib\Cli\Command\Set;
use FoxyMVC\Lib\Cli\Core\Register;

/**
 * Clase principal donde se inicializan los comandos
 */
class Application {
    /**
     * Visualizador de mensajes en la consola
     *
     * @var Printer
     */
    private Printer $printer;

    /**
     * Constructor de la clase Application
     */
    public function __construct() {
        $this->printer = new Printer();
        $set = new Set();
        $set->init();
    }

    /**
     * Inicializa la aplicación y divide las propiedades de las opciones
     *
     * @param array $argv Argumentos de la línea de comandos
     * @return void
     */
    public function run(array $argv) {
        // Obtener los argumentos y eliminar el primer elemento (nombre del archivo)
        $arguments = $argv;
        array_shift($arguments);

        // Si no se ha proporcionado un comando, mostrar un mensaje de error y salir
        if (!isset($argv[1])) $this->printer->error("Faltan argumentos");

        // Dividir el comando y el subcomando si existe
        [$cmd, $sub] = str_contains($argv[1], ":") ? explode(":", $argv[1]) : [$argv[1], null];

        // Eliminar el comando y el subcomando de los argumentos
        array_shift($arguments);

        // Comprobar si el comando y el subcomando están registrados
        if (Register::checkCommand([$cmd, $sub])) {
            // Convertir el comando y el subcomando a CamelCase
            $cmd = ucfirst($cmd);
            $sub = ucfirst($sub);

            // Definir la ruta del archivo del comando
            $commandFile = "FoxyMVC/Lib/Cli/Command/$cmd/$sub";

            // Si no existe la clase del comando, mostrar un mensaje de error y salir
            if (!class_exists($commandFile))
                $this->CommandError();

            // Obtener las opciones del comando (argumentos que empiezan con --)
            $subcommands = array_filter($arguments, function ($arg) {
                return strpos($arg, '--') === 0;
            });

            // Obtener los valores de las opciones del comando
            $values = [];
            foreach ($subcommands as $index => $subcommand) {
                $nextIndex = $index + 1;
                if (isset($arguments[$nextIndex]) && strpos($arguments[$nextIndex], '--') !== 0) $values[$subcommand] = $arguments[$nextIndex];
                else $values[$subcommand] = null;
            }

            // Agregar el subcomando a los argumentos
            $argv["sub"] = strtolower($sub);

            // Crear una instancia del comando y ejecutar el método init
            (new $commandFile($argv, $values))->init();
        } else {
            // Si el comando no está registrado, mostrar un mensaje de error y salir
            $this->CommandError();
        }
    }

    /**
     * Muestra un mensaje de error indicando que el comando no existe o está mal escrito
     *
     * @return void
     */
    protected function CommandError() {
        $this->printer->error(
            "El comando ingresado no existe o esta mal escrito"
        );
    }
}
