<?php

use FoxyMVC\App\Https\Controllers\HomeController;
use FoxyMVC\Lib\Foxy\Core\Route;

Route::set("", [HomeController::class, "home"])->name(constant("HOME"));