<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Event; 

class SuperAdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::whereIn('role', ['admin', 'registrasi'])->count();
        $adminUsersCount = User::where('role', 'admin')->count();
        $registrasiUsersCount = User::where('role', 'registrasi')->count();
        $totalEvents = Event::count(); 
        $eventsTerlaksana = Event::where('status', 'terlaksana')->count();
        $eventsBerlangsung = Event::where('status', 'berlangsung')->count();
        $eventsPending = Event::where('status', 'pending')->count(); 

        $title = 'Dashboard';

        return view('superadmin.home', compact(
            'title',
            'totalUsers',
            'adminUsersCount',
            'registrasiUsersCount',
            'totalEvents',
            'eventsTerlaksana',
            'eventsBerlangsung',
            'eventsPending'
        ));
    }
}
