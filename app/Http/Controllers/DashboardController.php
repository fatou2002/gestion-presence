<?php

namespace App\Http\Controllers;

use ConsoleTVs\Charts\Facades\Charts;
use App\Models\Presence;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        // Tu peux logger l'info si tu veux garder une trace
        // \Log::info("Dashboard accédé par un $role");

        return view('dashboard');
    }


}
