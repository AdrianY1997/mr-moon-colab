<?php

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http";

$url = explode("/", $_SERVER["SCRIPT_NAME"]);
array_pop($url);
$url = implode("/", $url);

$route_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $url . "/";

define("URL", $route_url);
define("BASE_URL", $base_url);
define("HOME", getenv("HOME"));
define("SITE", getenv("SITE"));
