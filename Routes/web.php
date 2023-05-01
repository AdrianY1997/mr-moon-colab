<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Https\Controllers\HomeController;

Route::set("", [HomeController::class, "index"])->name("root");
Route::set("inicio", [HomeController::class, "home"])->name(constant("HOME"));
