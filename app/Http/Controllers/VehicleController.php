<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('vehicles.home');
    }

    public function getAll()
    {
        return Vehicle::all();
    }

    public function add()
    {
        return view('vehicles.add');
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

    public function edit($id)
    {
        return view('vehicles.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->model         = $request->model;
        $vehicle->brand         = $request->brand;
        $vehicle->license_plate = $request->license_plate;
        $vehicle->version       = $request->version;

        $vehicle->save();
    }

    public function getCar($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return $vehicle;
    }
}
