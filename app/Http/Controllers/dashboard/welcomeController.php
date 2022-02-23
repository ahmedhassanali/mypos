<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('layouts.dashboard.index');
    }
}
