<?php

namespace App\Http\Controllers;

use App\Models\User; 

class SuperAdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::whereIn('role', ['admin', 'registrasi'])->count();
        $adminUsersCount = User::where('role', 'admin')->count();
        $registrasiUsersCount = User::where('role', 'registrasi')->count();
        $title = 'Dashboard';

        return view('superadmin.home', compact('title', 'totalUsers', 'adminUsersCount', 'registrasiUsersCount'));
    }
}
