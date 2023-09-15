<?php

use App\Http\Controllers\UsersControllers;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UsersControllers::class, 'index']);
Route::post('/users', [UsersControllers::class, 'store']);
Route::delete('/user/{id}', [UsersControllers::class, 'destroy']);
Route::put('/user/{id}', [UsersControllers::class, 'update']);
