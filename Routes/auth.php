<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Controllers\AuthController;
use FoxyMVC\App\Controllers\RecoveryController;
use FoxyMVC\App\Controllers\UserController;

Route::set("ingreso", [AuthController::class, "log_in"])->name("auth.login");
Route::set("registro", [AuthController::class, "sign_up"])->name("auth.signup");

Route::set("auth/start", [AuthController::class, "start_session"])->name("auth.start");
Route::set("auth/close", [AuthController::class, "close_session"])->name("auth.close");

Route::set("recuperacion", [RecoveryController::class, "recovery"])->name("auth.recovery");
Route::set("recovery/code/request", [RecoveryController::class, "request_recovery_code"])->name("auth.recovery.request.code");
Route::set("recovery/code/verify", [RecoveryController::class, "verify_recovery_code"])->name("auth.recovery.verify.code");
