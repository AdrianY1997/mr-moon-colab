<?php

namespace Lib\Cli\Core;

use Lib\Cli\Core\Printer;

class App
{
    protected $printer;
    protected $registry;

    public function __construct()
    {
        $this->printer = new Printer;
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerCommand($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    public function run(array $argv = [])
    {
        $command_name = "help";

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        $command = $this->getCommand($command_name);
        $this->getPrinter()->display("info", "Ejecutando comando: $command_name");

        if ($command === null) {
            $this->getPrinter()->display("warn", "El comando ingresado no esta registrado");
            $this->getPrinter()->display("warn", "Ejecute el comando de ayuda para ver los comandos registrados");
            $this->getPrinter()->display("warn", "$ php foxy help");
            $this->getPrinter()->display("erro", "Saliendo");
            $this->getPrinter()->nl();
            exit;
        }

        call_user_func($command, $argv);
    }
}
