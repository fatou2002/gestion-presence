<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        return view('dashboards.employee'); // Assure-toi que la vue existe aussi
    }

}
