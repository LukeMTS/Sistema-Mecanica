<?php

namespace App\Http\Controllers;

use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $vehicle = new Vehicle();

        $vehicle->user_id       = $request->user_id;
        $vehicle->model         = $request->model;
        $vehicle->brand         = $request->brand;
        $vehicle->license_plate = $request->license_plate;
        $vehicle->version       = $request->version;

        $vehicle->save();
    }
}
