<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once "Lib/Util/DotEnv.php";
include_once "vendor/autoload.php";

include_once "Lib/Util/helper.php";

define("DIR", __DIR__);

$app = require "Lib/Foxy/app.php";

$app->handle();

$app->terminate();
