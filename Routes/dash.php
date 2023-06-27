<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Https\Controllers\DashboardController;

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

Route::set("dashboard/usuarios/get/{id}", [DashboardController::class, "getUserInfo"])->name("dash.userGetInfo");
Route::set("dashboard/usuarios/set", [DashboardController::class, "setUserInfo"])->name("dash.userSetInfo");

Route::set("dashboard/menus/set/image/{id}", [DashboardController::class, "setMenuImg"])->name("dash.menuSetImg");