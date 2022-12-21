<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;

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

    public function getAll()
    {
        return Maintenance::all();
    }

    public function edit($id)
    {
        return view('maintenance.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $maintenance->description = $request->description;
        $maintenance->reason = $request->reason;
        $maintenance->deadline = $request->deadline;
        $maintenance->id_vehicle = $request->id_vehicle;

        $maintenance->save();
    }

    public function getMaintenance($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        return $maintenance;
    }

    public function store(Request $request)
    {
        $maintenance = new Maintenance();

        $maintenance->description = $request->description;
        $maintenance->reason = $request->reason;
        $maintenance->deadline = $request->deadline;
        $maintenance->id_vehicle = $request->id_vehicle;

        $maintenance->save();
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $maintenance->delete();
    }
}
