<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;
            if ($role == 'superadmin') {
                return redirect()->route('superadminhome');
            } elseif ($role == 'admin') {
                return redirect()->route('adminhome');
            } elseif ($role == 'registrasi') {
                return redirect()->route('registrasihome');
            }
        }

        return redirect()->back()->withErrors([
            'error' => 'Username atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
