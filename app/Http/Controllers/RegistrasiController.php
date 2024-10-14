<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class RegistrasiController extends Controller
{
    public function index(){
        $title = 'Dashboard';
        return view('registrasi.index');
    }
}
