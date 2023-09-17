<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class UsersControllers extends Controller
{
    public function index(Request $req)
    {
        $months = $this->getMonthsArray();

        $now = Carbon::now();
        $currentMonth = $now->month;
        $monthName = $months[$currentMonth];

        $usersInCurrentMonth = User::when(empty($req->mes), function ($query) use ($monthName) {
            return $query->where('month_created', '=', $monthName);
        })
        ->when(!empty($req->mes), function ($query) use ($req) {
            return $query->where('month_created', '=', $req->mes);
        })->get();

        return response()->json([
            'data' => $usersInCurrentMonth,
            'boxClosed' => Box::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:2',
            'price' => 'required',
            'type' => 'required'
        ]);

        $data['month_created'] = $request->month;

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

    private function getMonthsArray()
    {
        $months = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];

        return $months;
    }




}
