<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke(Request $request)
    {
        $usersData = $request->users;

        foreach ($usersData as $userData) {
            unset($userData['id']);
            $userData['month_created'] = 'Outubro';
            $userData['status'] = 'pendente';
            User::create($userData);
        }

        $data = Box::create([
            'total' => $request->total,
            'month' => $request->month,
            'closed' => true
        ]);

        return response()->json(['data' => $data], 201);
    }

}
