<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'registrasi'])->get();
        $title = 'Data User';

        return view('superadmin.datauser', compact('users', 'title'));
    }

    public function create()
    {
        return view('superadmin.createuser', ['title' => 'Tambah User']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users', 
            'password' => 'required|min:3',
            'role' => 'required|in:admin,registrasi',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    
        return redirect()->route('datauser')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('datauser')->with('success', 'User berhasil dihapus.');
    }
       
}
