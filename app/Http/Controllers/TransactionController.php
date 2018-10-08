<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;
use App\Repositories\RosterRepository;

class TransactionController extends Controller
{
    public function drop(Request $request, TransactionRepository $transaction, RosterRepository $roster)
    {
        $transaction->drop($request->id, $request->user_id, $request->week);

        if ($request->keeper === 1) {
            $roster->cap($request->user_id, $request->id, 0, $request->cap);
        }
    }

    public function add(Request $request, TransactionRepository $transaction, RosterRepository $roster)
    {
        $transaction->add($request->id, $request->user_id, $request->week);
    }

    public function trade(Request $request, TransactionRepository $transaction)
    {
        $transaction->trade($request->offered_by, $request->offered_to, $request->players, $request->picks);
    }
}
