<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RosterRepository;

class RosterController extends Controller
{
    public function scout(Request $request, RosterRepository $roster)
    {
        $roster->scout($request->id, $request->column);
    }

    public function block(Request $request, RosterRepository $roster)
    {
        $roster->manage($request->id, 'block');
    }

    public function keeper(Request $request, RosterRepository $roster)
    {
        $roster->manage($request->id, 'keeper');
        $roster->cap($request->user_id, $request->id, $request->value, $request->cap);
    }

    public function need(Request $request, RosterRepository $roster)
    {
        $roster->need($request->id, $request->column);
    }
}
