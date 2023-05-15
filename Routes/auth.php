<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Https\Controllers\AuthController;

Route::set("ingreso", [AuthController::class, "log_in"])->name("auth.login");
Route::set("registro", [AuthController::class, "sign_up"])->name("auth.signup");
Route::set("recuperacion", [AuthController::class, "recovery"])->name("auth.recovery");

Route::set("auth/start", [AuthController::class, "start_session"])->name("auth.start");
Route::set("auth/close", [AuthController::class, "close_session"])->name("auth.close");

Route::set("user/star", [AuthController::class, "new_user"])->name("user.star");

Route::set("recovery/code/request", [AuthController::class, "request_recovery_code"])->name("auth.recovery.request.code");
Route::set("recovery/code/verify", [AuthController::class, "verify_recovery_code"])->name("auth.recovery.verify.code");
