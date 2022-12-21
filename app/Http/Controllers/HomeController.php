<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function getNextMaintenances()
    {
        $maintenances = Maintenance::with('vehicle')
            ->selectRaw("*, DATEDIFF(deadline, CURDATE()) days")
            ->whereRaw('DATEDIFF(deadline, CURDATE()) <= 7')
            ->get();

        return $maintenances;
    }
}
