<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RosterRepository;

class RosterController extends Controller
{
    public function scout(Request $request, RosterRepository $roster)
    {
        $roster->scout($request->player_id, $request->column, $request->value);
    }

    public function block(Request $request, RosterRepository $roster)
    {
        $roster->block($request->id, $request->value);
    }

    public function keeper(Request $request, RosterRepository $roster)
    {
        $roster->keeper($request->id, $request->value);
        $roster->cap($request->user_id, $request->id, $request->value, $request->cap);
    }

    public function need(Request $request, RosterRepository $roster)
    {
        $roster->need($request->franchise_id, $request->need, $request->value);
    }
}
