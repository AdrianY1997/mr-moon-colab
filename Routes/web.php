<?php

use App\Site\Controllers\AuthController;
use App\Site\Controllers\DashboardController;
use App\Site\Controllers\EventosController;
use App\Site\Controllers\GaleriaController;
use App\Site\Controllers\InicioController;
use App\Site\Controllers\MenuController;
use App\Site\Controllers\ProfileController;
use App\Site\Controllers\ReservasController;
use Lib\Foxy\Core\Route;

Route::set("", [InicioController::class, "toHome"])->name("toHome");
Route::set("inicio", [InicioController::class, "index"])->name(constant("HOME"));
Route::set("testsly", [InicioController::class, "trySlyEngine"])->name("sly.test");

Route::set("ingreso", [AuthController::class, "log_in"])->name("auth.login");
Route::set("registro", [AuthController::class, "sign_up"])->name("auth.signup");
Route::set("recuperacion", [AuthController::class, "recovery"])->name("auth.recovery");
Route::set("auth.startSession", [AuthController::class, "start_session"])->name("auth.startSession");

Route::set("eventos", [EventosController::class, "index"])->name("event");
Route::set("galeria", [GaleriaController::class, "index"])->name("galery");
Route::set("menu", [MenuController::class, "index"])->name("menu");
Route::set("reservas", [ReservasController::class, "index"])->name("reserve");

Route::set("profile/{user}/edit", [ProfileController::class, "editar"])->name("profile.edit");

Route::set("dashboard", [DashboardController::class, "index"])->name("dash");
Route::set("dashboard/inicio", [DashboardController::class, "inicio"])->name("dash.home");
Route::set("dashboard/info", [DashboardController::class, "info"])->name("dash.info");
Route::set("dashboard/usuarios", [DashboardController::class, "usuarios"])->name("dash.users");
Route::set("dashboard/inventario", [DashboardController::class, "inventario"])->name("dash.stock");
Route::set("dashboard/facturas", [DashboardController::class, "facturas"])->name("dash.bill");
Route::set("dashboard/menu", [DashboardController::class, "menu"])->name("dash.menu");
Route::set("dashboard/reservas", [DashboardController::class, "reservas"])->name("dash.reserve");
Route::set("dashboard/eventos", [DashboardController::class, "eventos"])->name("dash.event");
Route::set("dashboard/galeria", [DashboardController::class, "galeria"])->name("dash.galery");
