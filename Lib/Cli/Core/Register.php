<?php

namespace FoxyMVC\Lib\Cli\Core;

/**
 * Clase para registrar comandos
 */
class Register {
    /**
     * Lista de comandos registrados
     *
     * @var array
     */
    static protected $commands = [];

    /**
     * Registra un comando con sus subcomandos
     *
     * @param string $cmd Nombre del comando
     * @param array $sub Lista de subcomandos
     */
    static function command(string $cmd, array $sub) {
        self::setCommand(["cmd" => $cmd, "sub" => $sub]);
    }

    /**
     * Agrega un comando a la lista de comandos registrados
     *
     * @param array $properties Propiedades del comando (cmd: nombre del comando, sub: lista de subcomandos)
     */
    static function setCommand(array $properties) {
        self::$commands[$properties["cmd"]] = $properties["sub"];
    }

    /**
     * Comprueba si un comando y un subcomando están registrados
     *
     * @param array $c Lista con el comando y el subcomando a comprobar
     * @return bool Verdadero si el comando y el subcomando están registrados, falso en caso contrario
     */
    static function checkCommand($c) {
        if (array_key_exists($c[0], self::$commands) && array_search($c[1], Register::$commands[$c[0]]) >= 0)
            return true;
        return false;
    }
}
