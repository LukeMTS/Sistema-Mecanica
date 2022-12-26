<?php

namespace App\Http\Controllers;

use App\Http\Requests\Maintenance\CreateMaintenanceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenanceRequest;
use App\Models\Maintenance;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function getAll(): JsonResponse
    {
        $maintenances = Maintenance::whereHas('vehicle', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->orderByDesc('id')->get();

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
        $maintenance->deadline    = $request->deadline;
        $maintenance->id_vehicle  = $request->id_vehicle;
        $maintenance->status_id   = 1;

        Session::flash('message', 'Manutenção criada com sucesso.');

        $maintenance->save();

        return response()->noContent();
    }

    public function update(UpdateMaintenanceRequest $request, $id): Response
    {
        $maintenance = Maintenance::findOrFail($id);

        $maintenance->description = $request->description;
        $maintenance->deadline    = $request->deadline;
        $maintenance->id_vehicle  = $request->id_vehicle;

        $maintenance->save();

        Session::flash('message', 'Manutenção atualizada com sucesso.');

        return response()->noContent();
    }

    public function destroy($id): Response
    {
        $maintenance = Maintenance::findOrFail($id);

        $maintenance->delete();

        return response()->noContent();
    }

    public function changeStatus(Request $request, $id)
    {
        Maintenance::where('id', $id)
            ->update(['status_id' => $request->status_id]);

        return response()->noContent();
    }
}
