<?php

namespace App\Http\Controllers\endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        return Status::find(1);
    }
}
