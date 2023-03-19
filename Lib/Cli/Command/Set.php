<?php

namespace Lib\Cli\Command;

use Lib\Cli\Core\Register;

class Set
{
    public function init()
    {
        Register::command("make",  [
            "controller",
            "model"
        ]);

        Register::command("migration", [
            "migrate",
            "rollback"
        ]);

        Register::command("server", [
            "start"
        ]);

        Register::command("database", [
            "create",
            "drop"
        ]);
    }
};
