<?php

use Lib\Autoloader;
use Lib\Foxy\Core\Application;
use Lib\Util\DotEnv;

(new Autoloader());
(new DotEnv(constant("DIR") . '/.env'))->load();

require_once "Config\\database.php";
require_once "Config\\site.php";
require_once "Routes\\web.php";
require_once "Routes\\exception.php";

return new Application();