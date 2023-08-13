<?php

namespace App\Http\Controllers;

use App\Models\cve;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $cve = cve::latest()->first();

        return view('dashboard', ['cve' => $cve]);
    }
}
