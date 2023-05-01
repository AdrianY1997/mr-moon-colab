<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Https\Controllers\HomeController;
use FoxyMVC\App\Https\Controllers\MenuController;
use FoxyMVC\App\Https\Controllers\EventosController;
use FoxyMVC\App\Https\Controllers\GaleriaController;
use FoxyMVC\App\Https\Controllers\ReservasController;

Route::set("", [HomeController::class, "index"])->name("root");
Route::set("inicio", [HomeController::class, "home"])->name(constant("HOME"));
Route::set("menu", [MenuController::class, "index"])->name("menu");
Route::set("reservas", [ReservasController::class, "index"])->name("reserve");
Route::set("eventos", [EventosController::class, "index"])->name("event");
Route::set("galeria", [GaleriaController::class, "index"])->name("galery");
