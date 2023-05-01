<?php

namespace FoxyMVC\Lib\Cli\Core;

use DateTime;

/**
 * Clase para mostrar mensajes en la consola
 */
class Printer {
    /**
     * Muestra un mensaje en la consola
     *
     * @param string $msg Mensaje a mostrar
     */
    public function out($msg) {
        echo $msg;
    }

    /**
     * Muestra un salto de línea en la consola
     */
    public function nl() {
        $this->out("\n");
    }

    /**
     * Muestra un mensaje con un tipo específico en la consola
     *
     * @param string $type Tipo de mensaje (erro, info, succ, warn)
     * @param string $msg Mensaje a mostrar
     */
    public function display($type, $msg) {
        $this->colorLog($type, $msg);
        $this->nl();
    }

    /**
     * Muestra uno o varios mensajes de error y sale del programa
     */
    public function error() {
        // Obtener los mensajes de error pasados como argumentos
        $msgs = func_get_args();

        // Mostrar cada mensaje de error con el tipo "warn"
        foreach ($msgs as $msg) {
            $this->display("warn", $msg);
        }

        // Mostrar un mensaje indicando que se está saliendo del programa y salir
        $this->display("erro", "Saliendo");
        $this->nl();
        exit;
    }

    /**
     * Muestra un mensaje con un color específico en la consola
     *
     * @param string $type Tipo de mensaje (erro, info, succ, warn)
     * @param string $str Mensaje a mostrar
     */
    public function colorLog($type, $str) {
        // Definir el color del mensaje según el tipo
        switch ($type) {
            case "erro":
                $color = '31m';
                break;
            case "info":
                $color = '36m';
                break;
            case "succ":
                $color = '32m';
                break;
            case "warn":
                $color = '33m';
                break;
            default:
                $color = '39m';
                break;
        }

        // Obtener la versión y la hora actual para mostrar en el encabezado del mensaje
        $version = constant("VER");
        $time = (new DateTime())->format("H:i:s");

        // Definir el encabezado del mensaje si el tipo no está vacío
        $header = $type ? "[$version $time|$type]" : "";
        $this->out("\033[$color$header\033[0m $str");
    }
}
