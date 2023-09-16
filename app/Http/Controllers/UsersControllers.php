<?php

namespace App\Http\Controllers;

use App\Models\Payment;
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
        $user = User::with('payment')->findOrFail($id);

        $data = [
            'user_id' => $id,
            'month_payment' => $request->status === 'pendente' ? '' : $request->month,
        ];

        $existingPayment = $user->payment
                        ->firstWhere('month_payment', $request->month);

        if ($existingPayment) {
            $existingPayment->delete();
            $user->update(['status' => 'pendente']);
        } else {
            Payment::create($data);
            $user->update(['status' => 'pago']);
        }

        return response()->json(true, 201);
    }




}
