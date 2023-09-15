<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersControllers extends Controller
{
    public function index()
    {
        return response()->json(['data' => User::all()]);
    }
}
