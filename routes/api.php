<?php

use App\Http\Controllers\UsersControllers;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UsersControllers::class, 'index']);
Route::post('/users', [UsersControllers::class, 'store']);
Route::delete('/users/{id}', [UsersControllers::class, 'destroy']);
