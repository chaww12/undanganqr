<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;

class AdminController extends Controller
{
    public function index(){
        $title = 'Dashboard';

        $totalEvents = Event::count();
        $eventsTerlaksana = Event::where('status', 'sudah terlaksana')->count();
        $eventsBerlangsung = Event::where('status', 'sedang berlangsung')->count();
        $eventsPending = Event::where('status', 'mendatang')->count(); 

        return view('admin.home', compact('title', 'totalEvents', 'eventsTerlaksana', 'eventsBerlangsung', 'eventsPending'));
    }

}
