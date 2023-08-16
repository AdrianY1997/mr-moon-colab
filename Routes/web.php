<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Controllers\HomeController;
use FoxyMVC\App\Controllers\MenuController;
use FoxyMVC\App\Controllers\EventosController;
use FoxyMVC\App\Controllers\GaleriaController;
use FoxyMVC\App\Controllers\ProfileController;
use FoxyMVC\App\Controllers\ReservasController;

Route::set("", [HomeController::class, "index"])->name("root");
Route::set("inicio", [HomeController::class, "home"])->name(constant("HOME"));
Route::set("inicio/star",[HomeController::class,"suscriber"])->name("home.star");
Route::set("menu", [MenuController::class, "index"])->name("menu");
Route::set("galeria", [GaleriaController::class, "index"])->name("galery");

Route::set("reservas", [ReservasController::class, "index"])->name("reserve");
Route::set("reserve/new", [ReservasController::class, "new"])->name("reserve.new");

Route::set("reservas/buscar", [ReservasController::class, "search"])->name("reserve.search");
Route::set("reserva/{urid}", [ReservasController::class, "show"])->name("reserve.show");
Route::set("reserve/confirm", [ReservasController::class, "confirm"])->name("reserve.confirm");
Route::set("reserve/hours", [ReservasController::class, "getHours"])->name("reserve.hours");

Route::set("profile", [ProfileController::class, "show"])->name("profile.show");
Route::set("profile/add", [ProfileController::class, "add"])->name("profile.add");
Route::set("profile/edit", [ProfileController::class, "edit"])->name("profile.edit");

Route::set("eventos", [EventosController::class, "index"])->name("event");
Route::set("evento/{id}", [EventosController::class, "get"])->name("event.get");