<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VehicleController extends Controller
{
    public function index()
    {
        return view('vehicles.home');
    }

    public function getAll(): JsonResponse
    {
        $vehicles = Vehicle::where('user_id', auth()->user()->id)
            ->orderByDesc('id')->get();

        return response()->json(['data' => $vehicles]);
    }

    public function add()
    {
        return view('vehicles.add');
    }

    public function store(CreateVehicleRequest $request): Response
    {
        $vehicle = new Vehicle();

        $vehicle->user_id       = auth()->user()->id;
        $vehicle->model         = $request->model;
        $vehicle->brand         = $request->brand;
        $vehicle->license_plate = $request->license_plate;
        $vehicle->version       = $request->version;

        $vehicle->save();

        Session::flash('message', 'Veículo criado com sucesso.');

        return response()->noContent();
    }

    public function destroy($id): Response
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->delete();

        return response()->noContent();
    }

    public function edit($id)
    {
        return view('vehicles.edit', compact('id'));
    }

    public function update(UpdateVehicleRequest $request, $id): Response
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->model         = $request->model;
        $vehicle->brand         = $request->brand;
        $vehicle->license_plate = $request->license_plate;
        $vehicle->version       = $request->version;

        $vehicle->save();

        Session::flash('message', 'Veículo atualizado com sucesso.');

        return response()->noContent();
    }

    public function getCar($id): JsonResponse
    {
        $vehicle = Vehicle::findOrFail($id);

        return response()->json(['data' => $vehicle]);
    }

    public function getCarsByUserId($id): JsonResponse
    {
        $vehicles = Vehicle::where('user_id', $id)->get();

        return response()->json(['data' => $vehicles]);
    }
}
