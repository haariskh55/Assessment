<?php

namespace App\Http\Controllers;

use App\Models\Visit;

class DashboardController extends Controller
{
    public function index()
    {
        $visitors = Visit::select('external_id')->distinct()->count();
        $stages = Visit::selectRaw('stage, COUNT(*) as count')->groupBy('stage')->get();

        return view('dashboard', compact('visitors', 'stages'));
    }
}
