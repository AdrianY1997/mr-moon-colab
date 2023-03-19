<?php

use App\Https\Controllers\ErrorController;
use Lib\Foxy\Core\Route;

Route::set("error/{msg}", [ErrorController::class, "code"])->name("error");
