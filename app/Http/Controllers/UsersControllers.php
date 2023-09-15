<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class UsersControllers extends Controller
{
    public function index()
    {
        return response()->json(['data' => User::all()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:2',
            'price' => 'required',
            'type' => 'required'
        ]);

        User::create($data);
        return response()->json($data, 201);
    }
}
