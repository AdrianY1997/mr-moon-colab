<?php

namespace Lib\Cli\Core;

use Lib\Cli\Command\Set;
use Lib\Cli\Core\Register;

class Application
{
    public function __construct()
    {
        (new Set())->init();
    }

    public function run(array $argv)
    {
        $arguments = $argv;
        array_shift($arguments);

        [$cmd, $sub] = str_contains($argv[1], ":")
            ? explode(":", $argv[1])
            : [$argv[1], null];

        array_shift($arguments);

        if (Register::checkCommand([$cmd, $sub])) {
            $cmd = ucfirst($cmd);
            $sub = ucfirst($sub);
            $commandFile = "Lib\\Cli\\Command\\$cmd\\$sub";

            if (!class_exists($commandFile))
                $this->CommandError();

            $subcommands = array_filter($arguments, function ($arg) {
                return strpos($arg, '--') === 0;
            });

            $values = [];
            foreach ($subcommands as $index => $subcommand) {
                $nextIndex = $index + 1;
                if (isset($arguments[$nextIndex]) && strpos($arguments[$nextIndex], '--') !== 0) {
                    $values[$subcommand] = $arguments[$nextIndex];
                } else {
                    $values[$subcommand] = null;
                }
            }

            $argv["sub"] = strtolower($sub);

            (new $commandFile($argv, $values))->init();
        } else {
            $this->CommandError();
        }
    }

    protected function CommandError()
    {
        (new Printer())->error(
            "El comando ingresado no existe o esta mal escrito"
        );
    }
}
