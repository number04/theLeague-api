<?php

namespace App\Http\Controllers\endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\trades\DetailResource;
use App\Models\Trade;

class TradeController extends Controller
{
    private function trade()
    {
        return Trade::with([
            'player',
            'pick'
        ]);
    }

    public function index()
    {
        return DetailResource::collection($this->trade()->get());
    }

    public function show($franchise)
    {
        return DetailResource::collection(
            $this->trade()
                ->where(function ($query) use($franchise) {
                    $query->where('offered_by', '=', $franchise)->orWhere('offered_to', '=', $franchise);
                })
                ->where(function ($query) use($franchise) {
                    $query->where('open', '=', 1)->orWhere('accepted', '=', 1);
                })
                ->get()
        );
    }
}
