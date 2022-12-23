<?php

namespace App\Http\Controllers;

use App\Http\Requests\Maintenance\CreateMaintenanceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenanceRequest;
use App\Models\Maintenance;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance.home');
    }

    public function add()
    {
        return view('maintenance.add');
    }

    public function getAll($userId): JsonResponse
    {
        $maintenances = Maintenance::whereHas('vehicle', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return response()->json(['data' => $maintenances]);
    }

    public function edit($id)
    {
        return view('maintenance.edit', compact('id'));
    }

    public function getMaintenance($id): JsonResponse
    {
        $maintenance = Maintenance::findOrFail($id);

        return response()->json(['data' => $maintenance]);
    }

    public function store(CreateMaintenanceRequest $request): Response
    {
        $maintenance = new Maintenance();

        $maintenance->description = $request->description;
        $maintenance->deadline = $request->deadline;
        $maintenance->id_vehicle = $request->id_vehicle;

        $maintenance->save();

        return response()->noContent();
    }

    public function update(UpdateMaintenanceRequest $request, $id): Response
    {
        $maintenance = Maintenance::findOrFail($id);

        $maintenance->description = $request->description;
        $maintenance->deadline = $request->deadline;
        $maintenance->id_vehicle = $request->id_vehicle;

        $maintenance->save();

        return response()->noContent();
    }

    public function destroy($id): Response
    {
        $maintenance = Maintenance::findOrFail($id);

        $maintenance->delete();

        return response()->noContent();
    }
}
