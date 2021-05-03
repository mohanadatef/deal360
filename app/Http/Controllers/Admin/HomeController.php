<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function error_403()
    {
        return view('errors.403');
    }

}
