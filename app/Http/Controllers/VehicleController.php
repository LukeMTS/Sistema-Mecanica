<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function add()
    {
        $vehicles = Vehicle::all();

        return view('vehicles.add', compact('vehicles'));
    }

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

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->delete();
    }
}
