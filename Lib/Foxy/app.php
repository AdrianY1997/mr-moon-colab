<?php

use FoxyMVC\Lib\Foxy\Core\Application;
use FoxyMVC\Lib\Util\DotEnv;

(new DotEnv(constant("DIR") . '/.env'))->load();

require_once "Config\\database.php";
require_once "Config\\site.php";

return new Application();
