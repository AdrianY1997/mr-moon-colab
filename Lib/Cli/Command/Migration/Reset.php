<?php

namespace FoxyMVC\Lib\Cli\Command\Migration;

use FoxyMVC\Lib\Cli\Command\Migration\Rollback;
use FoxyMVC\Lib\Cli\Command\Migration\Migrate;
use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase para migrar la base de datos
 */
class Reset extends Command {
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
   * Inicializa la migración
   *
   * @return void
   */
  public function init() {
    $rollback = new Rollback($this->property, $this->options);
    $rollback->init();
    $migrate = new Migrate($this->property, $this->options);
    $migrate->init();
  }
}
