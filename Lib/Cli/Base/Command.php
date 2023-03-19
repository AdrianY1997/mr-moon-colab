<?php

namespace Lib\Cli\Base;

class Command
{

    protected $printer;
    protected $argv;

    public function __construct($app, $argv)
    {
        $this->printer = $app->getPrinter();
        $this->argv = $argv;
    }
}
