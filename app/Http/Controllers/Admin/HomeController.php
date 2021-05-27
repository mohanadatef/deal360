<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard-show')->only('index');
    }
    public function index()
    {
        return view('admin.admin');
    }

    public function error_403()
    {
        return view('errors.403');
    }

}
