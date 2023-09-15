<?php

use App\Http\Controllers\UsersControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UsersControllers::class, 'index']);
