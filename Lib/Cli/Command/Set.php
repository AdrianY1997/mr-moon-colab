<?php

namespace Lib\Cli\Command;

use Lib\Cli\Core\Register;

class Set
{
    public function init()
    {
        Register::command("make",  [
            "controller",
            "migration",
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
            "backup",
            "create",
            "drop"
        ]);
    }
};
