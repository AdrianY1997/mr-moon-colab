<?php

namespace Lib\Cli\Command\Server;

use Lib\Cli\Core\Base\Command;

class Start extends Command
{
    public function __construct($pro, $avs)
    {
        parent::__construct($pro, $avs);
    }

    public function init()
    {
        $port = $this->options["--p"] ?? $this->options["--port"] ?? 1005;
        $host = $this->options["--h"] ?? $this->options["--host"] ?? "127.0.0.1";

        $command = sprintf('php -S %s:%d', $host, $port);

        $this->printer->display("info", "Iniciando Servidor en http://$host:$port");
        exec($command);
    }
}
