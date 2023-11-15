<?php

use FoxyMVC\Lib\Cli\Core\Application;
use FoxyMVC\Lib\Util\DotEnv;

$dotenv = new DotEnv(constant("DIR") . '/.env');
$dotenv->load();

require_once constant("DIR") . "/Config/Database.php";

return new Application();
