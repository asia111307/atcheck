<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('layouts.adminpanel');
    }

    public function test_connection()
    {
        return view('admin.admin_testconnection');
    }
}
