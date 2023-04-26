<?php

use FoxyMVC\App\Https\Controllers\ErrorController;
use FoxyMVC\Lib\Foxy\Core\Route;

Route::set("error/{msg}", [ErrorController::class, "code"])->name("error");
