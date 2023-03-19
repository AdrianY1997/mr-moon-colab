<?php

namespace Lib\Cli\Command;

use Lib\Cli\Base\Command;
use Exception;

class Serve extends Command
{
    public function __construct($app, $argv)
    {
        parent::__construct($app, $argv);
        $this->run();
    }

    private function run()
    {
        try {
            $defPort = 1200;
            $port = $this->getPort();
            $this->startServer($port, $defPort);
        } catch (Exception $e) {
            $this->printer->error(
                $e->getMessage(),
                "Modo de uso: ",
                "$ php serve [puerto]",
                "[puerto]: <int: 1 - 65535>"
            );
        }
    }

    private function getPort()
    {
        if (!isset($this->argv[2])) {
            return null;
        }
        $port = $this->argv[2];

        $port = filter_var($port, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1, "max_range" => 65535)));
        if (!$port)
            throw new Exception("El puerto especificado no es válido");


        if (!is_numeric($port)) {
            throw new Exception("El puerto especificado no es válido, debe ser un número");
        }

        return $port;
    }

    private function startServer($port, $defPort)
    {
        if (!$port) {
            $this->printer->display("info", "No se ha indicado un puerto, se usará el puerto por defecto [$defPort]");
            $port = $defPort;
        }

        $this->printer->display("info", "Iniciando servidor en localhost:$port");
        exec("php -S localhost:$port");
    }
}
