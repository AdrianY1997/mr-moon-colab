<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Https\Controllers\HomeController;
use FoxyMVC\App\Https\Controllers\MenuController;
use FoxyMVC\App\Https\Controllers\EventosController;
use FoxyMVC\App\Https\Controllers\GaleriaController;
use FoxyMVC\App\Https\Controllers\ProfileController;
use FoxyMVC\App\Https\Controllers\ReservasController;

Route::set("", [HomeController::class, "index"])->name("root");
Route::set("inicio", [HomeController::class, "home"])->name(constant("HOME"));
Route::set("menu", [MenuController::class, "index"])->name("menu");
Route::set("eventos", [EventosController::class, "index"])->name("event");
Route::set("galeria", [GaleriaController::class, "index"])->name("galery");

Route::set("reservas", [ReservasController::class, "index"])->name("reserve");
Route::set("reserve/new", [ReservasController::class, "new"])->name("reserve.new");

Route::set("reservas/buscar", [ReservasController::class, "search"])->name("reserve.search");
Route::set("reserva/{urid}", [ReservasController::class, "show"])->name("reserve.show");
Route::set("reserve/confirm", [ReservasController::class, "confirm"])->name("reserve.confirm");

Route::set("profile", [ProfileController::class, "show"])->name("profile.show");
Route::set("profile/edit", [ProfileController::class, "edit"])->name("profile.edit");