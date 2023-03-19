<?php

use App\Site\Controllers\HomeController;
use Lib\Foxy\Core\Route;

Route::set("", [HomeController::class, "home"])->name(constant("HOME"));
