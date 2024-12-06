<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard');
    }
}
