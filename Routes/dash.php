<?php

use FoxyMVC\App\Controllers\GaleriaController;
use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Controllers\DashboardController;
use FoxyMVC\App\Controllers\EventosController;
use FoxyMVC\App\Controllers\InventoryController;
use FoxyMVC\App\Controllers\ProviderController;
use FoxyMVC\App\Controllers\ReservasController;

Route::set("dashboard", [DashboardController::class, "index"])->name("dash");
Route::set("dashboard/inicio", [DashboardController::class, "inicio"])->name("dash.home");
Route::set("dashboard/usuarios", [DashboardController::class, "usuarios"])->name("dash.users");

Route::set("dashboard/info", [DashboardController::class, "info"])->name("dash.info");
Route::set("dashboard/webinfo/update", [DashboardController::class, "updateWebInfo"])->name("dash.info.update");

Route::set("dashboard/proveedores", [DashboardController::class, "proveedores"])->name("dash.prov");
Route::set("dashboard/proveedores/item/{id}", [ProviderController::class, "getProv"])->name("prov.getInfo");

Route::set("dashboard/proveedor/new-item", [ProviderController::class, "add"])->name("prov.add");
Route::set("dashboard/proveedor/edit-item/{id}", [ProviderController::class, "edit"])->name("prov.edit");
Route::set("dashboard/proveedor/delete-item/{id}", [ProviderController::class, "delete"])->name("prov.delete");

Route::set("dashboard/inventario", [DashboardController::class, "inventario"])->name("dash.stock");
Route::set("dashboard/inventario/item/{id}", [DashboardController::class, "getItem"])->name("dash.itemGetInfo");
Route::set("dashboard/inventario/proveedores", [DashboardController::class, "getProv"])->name("dash.getProv");

Route::set("dashboard/inventario/new-item", [InventoryController::class, "add"])->name("inv.add");
Route::set("dashboard/inventario/edit-item/{id}", [InventoryController::class, "edit"])->name("inv.edit");
Route::set("dashboard/inventario/delete-item/{id}", [InventoryController::class, "delete"])->name("inv.delete");


Route::set("dashboard/menu", [DashboardController::class, "menu"])->name("dash.menu");
Route::set("dashboard/galeria", [DashboardController::class, "galeria"])->name("dash.galery");

Route::set("dashboard/usuarios/get/{id}", [DashboardController::class, "getUserInfo"])->name("dash.userGetInfo");
Route::set("dashboard/usuarios/set", [DashboardController::class, "setUserInfo"])->name("dash.userSetInfo");

Route::set("dashboard/menus/set/image/{id}", [DashboardController::class, "setMenuImg"])->name("dash.menuSetImg");

Route::set("dashboard/reservas", [DashboardController::class, "reservas"])->name("dash.reserve");
Route::set("dashboard/reserves/get", [ReservasController::class, "get"])->name("dash.reserve.get");
Route::set("dashboard/reserves/confirm-payment", [ReservasController::class, "confirmPayment"])->name("dash.reserve.confirm.payment");
Route::set("dashboard/reserves/cancel-payment", [ReservasController::class, "cancelPayment"])->name("dash.reserve.cancel.payment");

Route::set("dashboard/eventos", [DashboardController::class, "eventos"])->name("dash.event");
Route::set("dashboard/eventos/new-item", [EventosController::class, "add"])->name("even.add");
Route::set("dashboard/eventos/edit-item/{id}", [EventosController::class, "edit"])->name("even.edit");
Route::set("dashboard/eventos/delete-item/{id}", [EventosController::class, "delete"])->name("even.delete");
Route::set("dashboard/eventos", [DashboardController::class, "evento"])->name("dash.even");

Route::set("dashboard/galerias/set/image/{id}", [DashboardController::class, "setGaleriaImg"])->name("dash.GaleriaSetImg");
Route::set("dashboard/galerias/new-item", [GaleriaController::class, "add"])->name("gal.add");
Route::set("dashboard/galerias/delete-item/{id}", [GaleriaController::class, "delete"])->name("gal.delete");

Route::set("dashboard/events/set/image/{id}", [DashboardController::class, "setEventosImg"])->name("dash.EventSetImg");

