<?php

namespace App\Http\Controllers\endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movement;
use App\Http\Resources\MovementResource;

class MovementController extends Controller
{
    public function index()
    {
        return MovementResource::collection(Movement::latest()->limit(10)->get());
    }
}
