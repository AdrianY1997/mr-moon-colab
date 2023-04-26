<?php

namespace FoxyMVC\Lib\Cli\Core\Base;

use PDO;
use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase de conexión a la base de datos
 */
class Connection extends Command {
    protected string $name;
    protected string $host;
    protected string $user;
    protected string $pass;
    protected string $port;
    protected string $chst;
    protected string $dpfl;
    protected string $dbfl;
    protected PDO $pdo;

    /**
     * Constructor de la clase Connection
     *
     * @param array $pro
     * @param array $avs
     */
    public function __construct($pro = [], $avs = []) {
        parent::__construct($pro, $avs);

        // Obtener las constantes de configuración de la base de datos
        $this->name = constant('DBNAME');
        $this->host = constant('DBHOST');
        $this->user = constant('DBUSER');
        $this->pass = constant('DBPASS');
        $this->port = constant('DBPORT');
        $this->chst = constant('DBCHST');
        $this->dpfl = getenv("DPFILE");
        $this->dbfl = getenv("DBFILE");

        // Conectar a la base de datos
        $this->pdo = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ",charset=" . $this->chst . "", $this->user, $this->pass);
    }
}
