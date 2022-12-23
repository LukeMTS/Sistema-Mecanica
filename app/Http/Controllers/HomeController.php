<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('dashboard');
    }

    public function getNextMaintenances(): JsonResponse
    {
        $maintenances = Maintenance::with('vehicle')
            ->selectRaw("*, DATEDIFF(deadline, CURDATE()) days")
            ->whereRaw('DATEDIFF(deadline, CURDATE()) <= 7')
            ->get();

        return response()->json(['data' => $maintenances]);
    }
}
