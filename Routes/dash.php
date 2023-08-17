<?php

use FoxyMVC\Lib\Foxy\Core\Route;
use FoxyMVC\App\Controllers\DashboardController;
use FoxyMVC\App\Controllers\EventosController;
use FoxyMVC\App\Controllers\InventoryController;
use FoxyMVC\App\Controllers\ProviderController;
use FoxyMVC\App\Models\Event;

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

Route::set("dashboard/facturas", [DashboardController::class, "facturas"])->name("dash.bill");

Route::set("dashboard/menu", [DashboardController::class, "menu"])->name("dash.menu");

Route::set("dashboard/reservas", [DashboardController::class, "reservas"])->name("dash.reserve");

Route::set("dashboard/galeria", [DashboardController::class, "galeria"])->name("dash.galery");

Route::set("dashboard/usuarios/get/{id}", [DashboardController::class, "getUserInfo"])->name("dash.userGetInfo");
Route::set("dashboard/usuarios/set", [DashboardController::class, "setUserInfo"])->name("dash.userSetInfo");

Route::set("dashboard/menus/set/image/{id}", [DashboardController::class, "setMenuImg"])->name("dash.menuSetImg");


Route::set("dashboard/eventos", [DashboardController::class, "eventos"])->name("dash.event");

Route::set("dashboard/eventos/new-item", [DashboardController::class, "add"])->name("even.add");
Route::set("dashboard/eventos/edit-item/{id}", [DashboardController::class, "edit"])->name("even.edit");