<?php

use Illuminate\Support\Facades\Route;
use Lmottasin\LaravelPermissionEditor\Http\Controllers\PermissionController;
use Lmottasin\LaravelPermissionEditor\Http\Controllers\RoleController;

Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
