<?php

include_once "Lib/Util/DotEnv.php";
require_once "Lib/Autoloader.php";

use Lib\Autoloader;
use Lib\Util\DotEnv;

(new Autoloader());
(new DotEnv(constant("DIR") . '/.env'))->load();

require_once "Config\\database.php";

use Lib\Cli\Command\Create;
use Lib\Cli\Command\Database;
use Lib\Cli\Command\Serve;
use Lib\Cli\Core\App;

define("VER", "Alpha-v0.1");

$app = new App();

$app->registerCommand(
    "serve",
    function (array $argv) use ($app) {
        (new Serve($app, $argv));
    }
);

$app->registerCommand(
    "create",
    function (array $argv) use ($app) {
        (new Create($app, $argv));
    }
);

$app->registerCommand(
    "database",
    function (array $argv) use ($app) {
        (new Database($app, $argv));
    }
);

return $app;
