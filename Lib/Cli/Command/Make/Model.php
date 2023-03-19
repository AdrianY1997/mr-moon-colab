<?php

namespace Lib\Cli\Command\Make;

use Lib\Cli\Command\Make\MakeComponent;

class Model extends MakeComponent
{
    public function __construct($pro, $avs)
    {
        parent::__construct($pro, $avs);
    }

    public function init()
    {
        $this->make();
    }
}
