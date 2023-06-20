<?php

use FoxyMVC\App\Https\Controllers\UserController;
use FoxyMVC\Lib\Foxy\Core\Route;

Route::set("user/star", [UserController::class, "new_user"])->name("user.star");
Route::set("user/delete/{user_id}", [UserController::class, "delete_user"])->name("user.delete");
Route::set("user/edit/{user_id}", [UserController::class, "edit_user"])->name("edit.delete");