<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboards.admin'); // Assure-toi que la vue existe aussi
    }

}
