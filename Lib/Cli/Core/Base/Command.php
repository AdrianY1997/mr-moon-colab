<?php

namespace FoxyMVC\Lib\Cli\Core\Base;

use FoxyMVC\Lib\Cli\Core\Printer;

/**
 * Clase base de los comandos
 */
class Command {
    /**
     * Argumentos de la linea de comandos
     *
     * @var array
     */
    protected array $property;

    /**
     * Argumentos sacados con el prefijo --
     *
     * @var array
     */
    protected array $options;

    /**
     * Visualizador de mensajes de la consola
     *
     * @var Printer
     */
    protected Printer $printer;

    /**
     * Constructor de la clase Command
     *
     * @param array $property
     * @param array $options
     */
    public function __construct(array $property, array $options) {
        $this->property = $property;
        $this->options = $options;
        $this->printer = new Printer();
    }
}
