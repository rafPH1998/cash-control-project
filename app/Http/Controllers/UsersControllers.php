<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class UsersControllers extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => User::all(),
        ]);
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

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([], 204);
    }

    public function update(string $id, Request $request)
    {
        $user = User::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];

        if ($request->status === 'pendente') {
            $data['month_payment'] = '';
        } else {
            $data['month_payment'] = $request->month;
        }

        $user->update($data);

        return response()->json(true, 200);
    }




}
