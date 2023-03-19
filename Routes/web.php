<?php

use App\Https\Controllers\HomeController;
use Lib\Foxy\Core\Route;

Route::set("", [HomeController::class, "home"])->name(constant("HOME"));
