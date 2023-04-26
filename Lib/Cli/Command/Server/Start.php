<?php

namespace FoxyMVC\Lib\Cli\Command\Server;

use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase para iniciar el servidor
 */
class Start extends Command {
    /**
     * Constructor de la clase Backup
     *
     * @param array $pro Propiedades
     * @param array $avs Argumentos
     */
    public function __construct($pro, $avs) {
        parent::__construct($pro, $avs);
    }

    /**
     * Inicializa el servidor
     *
     * @return void
     */
    public function init() {
        // Obtiene el host y puerto donde se ejecutara el servidor
        $host = $this->options["--h"] ?? $this->options["--host"] ?? "127.0.0.1";
        $port = $this->options["--p"] ?? $this->options["--port"] ?? 1005;

        // Se ejecuta el comando
        $command = sprintf('php -S %s:%d', $host, $port);
        $this->printer->display("info", "Iniciando Servidor en http://$host:$port");
        exec($command);
    }
}
