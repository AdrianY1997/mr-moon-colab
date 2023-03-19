<?php

namespace Lib\Cli\Core;

class Loader
{
    public function init()
    {
        $this->core();
        $this->command();
    }

    private function command()
    {
        $this->load([
            "Lib\\Cli\\Command\\Command.php",
            "Lib\\Foxy\\Core\\Schema.php",
            "Lib\\Foxy\\Core\\Blueprint.php",
            "Lib\\Cli\\Command\\Serve.php",
            "Lib\\Cli\\Command\\Create.php",
            "Lib\\Cli\\Command\\Database.php",
        ]);
    }

    private function core()
    {
        $this->load([
            "Lib\\Cli\\Core\\Printer.php",
            "Lib\\Cli\\Core\\App.php",
        ]);
    }

    private function load(array $list)
    {
        foreach ($list as $key => $element) {
            require_once $element;
        }
    }
}
