<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function getStatus()
    {
        $status = Status::all();

        return response()->json(['data' => $status]);
    }
}
